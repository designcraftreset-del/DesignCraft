<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->timestamp('chat_closed_at')->nullable()->after('status');
            $table->string('preview_path', 500)->nullable()->after('chat_closed_at');
            $table->timestamp('preview_sent_at')->nullable()->after('preview_path');
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['chat_closed_at', 'preview_path', 'preview_sent_at']);
        });
    }
};
