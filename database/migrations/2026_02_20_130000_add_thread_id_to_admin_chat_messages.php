<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('thread_id')->nullable()->after('chat_type');
        });
    }

    public function down()
    {
        Schema::table('admin_chat_messages', function (Blueprint $table) {
            $table->dropColumn('thread_id');
        });
    }
};
