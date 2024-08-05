<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kl_answers', function (Blueprint $table) {
            $table->foreignId('kl_question_id');
            $table->foreign('kl_question_id')
            ->references('id')
            ->on('kl_questions')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('player_id');
            $table->foreign('player_id')
            ->references('id')
            ->on('players')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('answer');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kl_answers');
    }
};
