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
            $table->string('answer', 1);
            $table->enum('status', ['Benar', 'Salah']);
            $table->timestamps();

            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('tupal_question_id');
            
            // primary key
            $table->primary(['player_id', 'tupal_question_id']);

            // foreign key constraint
            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tupal_question_id')
                ->references('id')
                ->on('tupal_questions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
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
