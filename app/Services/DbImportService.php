<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DbImportService
{
    /** Default table order for import (migrations skipped for insert). */
    private const TABLE_ORDER = [
        'migrations', 'users', 'password_resets', 'failed_jobs', 'personal_access_tokens',
        'reviews', 'applications', 'banners', 'news', 'admin_chat_messages', 'services',
        'support_threads', 'support_thread_reads',
    ];

    /**
     * Import JSON export from directory into current DB.
     *
     * @param string $path Absolute path to directory with table_name.json files
     * @param bool $force Truncate tables before import (except migrations)
     * @return array{imported: int, messages: string[], success: bool, error?: string}
     */
    public function run(string $path, bool $force = false): array
    {
        $messages = [];

        if (!is_dir($path)) {
            return [
                'imported' => 0,
                'messages' => [],
                'success' => false,
                'error' => "Directory not found: {$path}. Add JSON export to database/db-export and commit, or run php artisan db:export.",
            ];
        }

        $tables = $this->getTablesInOrder($path);
        if (empty($tables)) {
            return [
                'imported' => 0,
                'messages' => ['No .json files found in ' . $path],
                'success' => true,
            ];
        }

        $driver = DB::connection()->getDriverName();

        if ($force) {
            $toTruncate = array_filter($tables, fn ($t) => $t !== 'migrations' && Schema::hasTable($t));
            if ($toTruncate) {
                try {
                    if ($driver === 'pgsql') {
                        $list = implode(', ', array_map(fn ($t) => "\"{$t}\"", $toTruncate));
                        DB::statement("TRUNCATE TABLE {$list} RESTART IDENTITY CASCADE");
                        $messages[] = 'Truncated: ' . implode(', ', $toTruncate);
                    } elseif ($driver === 'mysql') {
                        DB::statement('SET FOREIGN_KEY_CHECKS=0');
                        foreach (array_reverse($toTruncate) as $table) {
                            DB::table($table)->truncate();
                        }
                        DB::statement('SET FOREIGN_KEY_CHECKS=1');
                        $messages[] = 'Truncated: ' . implode(', ', $toTruncate);
                    } else {
                        foreach (array_reverse($toTruncate) as $table) {
                            DB::table($table)->truncate();
                            $messages[] = "Truncated {$table}";
                        }
                    }
                } catch (\Throwable $e) {
                    return [
                        'imported' => 0,
                        'messages' => $messages,
                        'success' => false,
                        'error' => 'Truncate failed: ' . $e->getMessage(),
                    ];
                }
            }
        }

        $imported = 0;
        foreach ($tables as $table) {
            if ($table === 'migrations') {
                continue;
            }
            $file = $path . DIRECTORY_SEPARATOR . $table . '.json';
            if (!is_file($file)) {
                continue;
            }
            $data = json_decode(file_get_contents($file), true);
            if (!is_array($data) || empty($data)) {
                $messages[] = "Skip {$table}: empty or invalid";
                continue;
            }
            if (!Schema::hasTable($table)) {
                $messages[] = "Table {$table} does not exist, skip.";
                continue;
            }
            $chunks = array_chunk($data, 100);
            foreach ($chunks as $chunk) {
                DB::table($table)->insert($chunk);
            }
            $imported += count($data);
            $messages[] = "Imported {$table}: " . count($data) . " rows";
        }

        $messages[] = "Done. Total rows: {$imported}";
        return [
            'imported' => $imported,
            'messages' => $messages,
            'success' => true,
        ];
    }

    private function getTablesInOrder(string $path): array
    {
        $files = glob($path . '/*.json');
        $fromFiles = array_map(fn ($f) => basename($f, '.json'), $files ?: []);
        $ordered = [];
        foreach (self::TABLE_ORDER as $t) {
            if (in_array($t, $fromFiles)) {
                $ordered[] = $t;
            }
        }
        foreach ($fromFiles as $t) {
            if (!in_array($t, $ordered)) {
                $ordered[] = $t;
            }
        }
        return $ordered;
    }
}
