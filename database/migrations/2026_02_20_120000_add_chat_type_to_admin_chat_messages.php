<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->string('chat_type', 20)->default('admin')->after('id');
        });
    }

    public function down()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->dropColumn('chat_type');
        });
    }
};
