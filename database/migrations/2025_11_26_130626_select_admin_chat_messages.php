<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Выполняем SELECT запрос
        $results = DB::select('SELECT * FROM admin_chat_messages');
        
        // Можно добавить логирование результатов
        logger('Admin Chat Messages:', $results);
        
        // Или вывести в консоль при выполнении миграции
        if (app()->runningInConsole()) {
            echo "Результаты SELECT * FROM admin_chat_messages:\n";
            foreach ($results as $row) {
                echo "ID: {$row->id}, User: {$row->user_id}, Message: " . substr($row->message ?? '', 0, 50) . "...\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // В методе down обычно откатывают изменения, но для SELECT это не нужно
        // Можно оставить пустым или добавить логирование
        echo "Откат миграции SELECT запроса\n";
    }
};