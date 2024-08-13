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
        Schema::create('tupal_answers', function (Blueprint $table) {
            $table->primary('player_id'); 
            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary('tupal_question_id');
            $table->foreign('tupal_question_id')
                ->references('id')
                ->on('tupal_questions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('answer');
            $table->enum('status', ['Benar', 'Salah']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tupal_answers');
    }
};
