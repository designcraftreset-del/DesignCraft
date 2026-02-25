<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('message');
            $table->string('image_name')->nullable()->after('image_path');
        });
    }

    public function down()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'image_name']);
        });
    }
};