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
        Schema::create('player_sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id'); // Foreign key ke tabel players
            $table->unsignedBigInteger('tupal_session_id'); // Foreign key ke tabel tupal_questions
            
            $table->primary(['player_id', 'tupal_session_id']);

            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('tupal_session_id')
                ->references('id')
                ->on('tupal_sessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('skor')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_sessions');
    }
};
