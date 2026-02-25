<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('support_thread_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('thread_id');
            $table->timestamp('read_at')->nullable();
            $table->boolean('pinned')->default(false);
            $table->timestamps();
            $table->unique(['admin_id', 'thread_id']);
            $table->foreign('thread_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('support_thread_reads');
    }
};
