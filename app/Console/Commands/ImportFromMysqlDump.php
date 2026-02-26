<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportFromMysqlDump extends Command
{
    protected $signature = 'db:import-from-sql {file : path to MySQL dump .sql file} {--force}';
    protected $description = 'Parse MySQL dump and import data into current DB (e.g. Render PostgreSQL)';

    public function handle()
    {
        $path = $this->argument('file');
        if (!is_file($path)) {
            $this->error("File not found: {$path}");
            return 1;
        }
        $content = file_get_contents($path);
        $outDir = storage_path('app/db-export');
        if (!is_dir($outDir)) {
            mkdir($outDir, 0755, true);
        }

        // Find all INSERT INTO `table` (cols) VALUES ...
        if (!preg_match_all(
            "/INSERT INTO\s+`([^`]+)`\s*\(([^)]+)\)\s*VALUES\s*(.+?)(?=\s*;|\s*INSERT INTO|$)/s",
            $content,
            $matches,
            PREG_SET_ORDER
        )) {
            $this->error('No INSERT statements found in dump.');
            return 1;
        }

        $order = [
            'migrations', 'users', 'password_resets', 'failed_jobs', 'personal_access_tokens',
            'reviews', 'applications', 'banners', 'news', 'admin_chat_messages', 'services',
            'support_threads', 'support_thread_reads',
        ];
        $tablesDone = [];

        foreach ($matches as $m) {
            $table = $m[1];
            $colsStr = $m[2];
            $valsStr = trim($m[3]);
            $columns = array_map('trim', array_map(function ($c) {
                return trim($c, "` \t");
            }, explode(',', $colsStr)));
            $rows = $this->parseValues($valsStr, count($columns));
            if (empty($rows)) {
                continue;
            }
            $data = [];
            foreach ($rows as $row) {
                $data[] = array_combine($columns, $row);
            }
            $tablesDone[] = $table;
            $jsonPath = $outDir . '/' . $table . '.json';
            file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->info("Parsed {$table}: " . count($data) . " rows -> {$jsonPath}");
        }

        $this->info('JSON files saved to: ' . $outDir);
        $this->info('Run: php artisan db:import --force (with DATABASE_URL pointing to Render PostgreSQL)');
        return 0;
    }

    private function parseValues(string $valsStr, int $numCols): array
    {
        $rows = [];
        $len = strlen($valsStr);
        $i = 0;
        while ($i < $len) {
            $i = $this->skipWhitespace($valsStr, $i);
            if ($i >= $len || $valsStr[$i] !== '(') {
                break;
            }
            $i++;
            $row = [];
            for ($c = 0; $c < $numCols; $c++) {
                $i = $this->skipWhitespace($valsStr, $i);
                if ($i >= $len) {
                    break;
                }
                if (substr($valsStr, $i, 4) === 'NULL' && ($i + 4 >= $len || in_array($valsStr[$i + 4], [",", ")"]))) {
                    $row[] = null;
                    $i += 4;
                } elseif ($valsStr[$i] === "'") {
                    $i++;
                    $s = '';
                    while ($i < $len) {
                        if ($valsStr[$i] === '\\' && $i + 1 < $len) {
                            $s .= $valsStr[$i + 1];
                            $i += 2;
                            continue;
                        }
                        if ($valsStr[$i] === "'") {
                            $i++;
                            break;
                        }
                        $s .= $valsStr[$i];
                        $i++;
                    }
                    $row[] = $s;
                } else {
                    $start = $i;
                    while ($i < $len && $valsStr[$i] !== ',' && $valsStr[$i] !== ')') {
                        $i++;
                    }
                    $v = trim(substr($valsStr, $start, $i - $start));
                    $row[] = $v === '' ? null : (is_numeric($v) ? (strpos($v, '.') !== false ? (float)$v : (int)$v) : $v);
                }
                $i = $this->skipWhitespace($valsStr, $i);
                if ($i < $len && $valsStr[$i] === ',') {
                    $i++;
                }
            }
            if (count($row) === $numCols) {
                $rows[] = $row;
            }
            $i = $this->skipWhitespace($valsStr, $i);
            if ($i < $len && $valsStr[$i] === ')') {
                $i++;
            }
            $i = $this->skipWhitespace($valsStr, $i);
            if ($i < $len && $valsStr[$i] === ',') {
                $i++;
            }
        }
        return $rows;
    }

    private function skipWhitespace(string $s, int $i): int
    {
        while ($i < strlen($s) && in_array($s[$i], [" ", "\t", "\n", "\r"], true)) {
            $i++;
        }
        return $i;
    }
}
