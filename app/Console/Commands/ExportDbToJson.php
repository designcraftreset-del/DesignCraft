<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ExportDbToJson extends Command
{
    protected $signature = 'db:export {--path=storage/app/db-export}';
    protected $description = 'Export all tables from current DB to JSON (for import to Render PostgreSQL)';

    public function handle()
    {
        $path = base_path($this->option('path'));
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $tables = $this->getTablesInOrder();
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                $rows = DB::table($table)->get()->map(fn ($r) => (array) $r);
                $file = $path . '/' . $table . '.json';
                file_put_contents($file, json_encode($rows->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                $this->info("Exported {$table}: " . $rows->count() . " rows -> {$file}");
            }
        }
        $this->info("Done. Files in: {$path}");
        return 0;
    }

    /** Порядок таблиц (сначала без FK, потом зависимые) */
    private function getTablesInOrder(): array
    {
        $driver = DB::connection()->getDriverName();
        if ($driver === 'mysql') {
            $rows = DB::select('SHOW TABLES');
            $key = 'Tables_in_' . DB::connection()->getDatabaseName();
            $all = array_map(fn ($r) => $r->{$key}, $rows);
        } else {
            $all = DB::connection()->getSchemaBuilder()->getAllTables();
            $all = array_map(fn ($r) => is_object($r) ? ($r->tablename ?? $r->name ?? reset((array)$r)) : $r, $all);
        }
        $order = [
            'migrations', 'users', 'password_resets', 'failed_jobs', 'personal_access_tokens',
            'reviews', 'applications', 'banners', 'news', 'admin_chat_messages', 'services',
            'support_threads', 'support_thread_reads',
        ];
        $ordered = [];
        foreach ($order as $t) {
            if (in_array($t, $all)) {
                $ordered[] = $t;
            }
        }
        foreach ($all as $t) {
            if (!in_array($t, $ordered)) {
                $ordered[] = $t;
            }
        }
        return $ordered;
    }
}
