<?php

namespace App\Console\Commands;

use App\Services\DbImportService;
use Illuminate\Console\Command;

class ImportDbFromJson extends Command
{
    protected $signature = 'db:import {--path=storage/app/db-export} {--force}';
    protected $description = 'Import JSON export into current DB (e.g. Render PostgreSQL). Run after db:export locally.';

    public function handle(DbImportService $importService): int
    {
        $path = base_path($this->option('path'));
        $result = $importService->run($path, (bool) $this->option('force'));

        foreach ($result['messages'] as $msg) {
            $this->line($msg);
        }
        if (isset($result['error'])) {
            $this->error($result['error']);
            return 1;
        }
        return 0;
    }
}
