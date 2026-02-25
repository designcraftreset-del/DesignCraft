<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('image_name');
            $table->string('file_name')->nullable()->after('file_path');
        });
    }

    public function down()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'file_name']);
        });
    }
};
