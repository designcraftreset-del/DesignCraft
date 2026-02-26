<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportDbFromJson extends Command
{
    protected $signature = 'db:import {--path=storage/app/db-export} {--force}';
    protected $description = 'Import JSON export into current DB (e.g. Render PostgreSQL). Run after db:export locally.';

    public function handle()
    {
        $path = base_path($this->option('path'));
        if (!is_dir($path)) {
            $this->error("Directory not found: {$path}. Run php artisan db:export first.");
            return 1;
        }

        $driver = DB::connection()->getDriverName();
        $tables = $this->getTablesInOrder();
        $imported = 0;

        if ($this->option('force') && $tables) {
            $this->info('Truncating tables...');
            $toTruncate = array_filter($tables, fn ($t) => $t !== 'migrations' && Schema::hasTable($t));
            if ($driver === 'pgsql' && $toTruncate) {
                $list = implode(', ', array_map(fn ($t) => "\"{$t}\"", $toTruncate));
                try {
                    DB::statement("TRUNCATE TABLE {$list} RESTART IDENTITY CASCADE");
                    $this->line('  Truncated: ' . implode(', ', $toTruncate));
                } catch (\Throwable $e) {
                    $this->warn('  ' . $e->getMessage());
                }
            } elseif ($driver === 'mysql' && $toTruncate) {
                try {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    foreach (array_reverse($toTruncate) as $table) {
                        DB::table($table)->truncate();
                        $this->line("  Truncated {$table}");
                    }
                    DB::statement('SET FOREIGN_KEY_CHECKS=1');
                } catch (\Throwable $e) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=1');
                    throw $e;
                }
            } else {
                foreach (array_reverse($toTruncate) as $table) {
                    try {
                        DB::table($table)->truncate();
                        $this->line("  Truncated {$table}");
                    } catch (\Throwable $e) {
                        $this->warn("  Skip {$table}: " . $e->getMessage());
                    }
                }
            }
        }

        foreach ($tables as $table) {
            if ($table === 'migrations') {
                continue; // не перезаписываем состояние миграций на Render
            }
            $file = $path . '/' . $table . '.json';
            if (!is_file($file)) {
                continue;
            }
            $data = json_decode(file_get_contents($file), true);
            if (!is_array($data) || empty($data)) {
                $this->line("Skip {$table}: empty or invalid");
                continue;
            }
            if (!Schema::hasTable($table)) {
                $this->warn("Table {$table} does not exist, skip.");
                continue;
            }
            $chunks = array_chunk($data, 100);
            foreach ($chunks as $chunk) {
                DB::table($table)->insert($chunk);
            }
            $imported += count($data);
            $this->info("Imported {$table}: " . count($data) . " rows");
        }
        $this->info("Done. Total rows: {$imported}");
        return 0;
    }

    private function getTablesInOrder(): array
    {
        $order = [
            'migrations', 'users', 'password_resets', 'failed_jobs', 'personal_access_tokens',
            'reviews', 'applications', 'banners', 'news', 'admin_chat_messages', 'services',
            'support_threads', 'support_thread_reads',
        ];
        $path = base_path($this->option('path'));
        $files = is_dir($path) ? glob($path . '/*.json') : [];
        $fromFiles = array_map(fn ($f) => basename($f, '.json'), $files);
        $ordered = [];
        foreach ($order as $t) {
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
