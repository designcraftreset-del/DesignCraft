<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->softDeletes(); // Добавляем только deleted_at
        });
    }

    public function down()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};