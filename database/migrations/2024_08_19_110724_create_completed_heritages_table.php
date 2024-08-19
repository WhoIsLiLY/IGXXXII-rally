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
        Schema::create('completed_heritages', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id'); // Foreign key ke tabel players
            $table->unsignedBigInteger('heritage_id'); // Foreign key ke tabel tupal_questions
            
            $table->primary(['player_id', 'heritage_id']);

            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('heritage_id')
                ->references('id')
                ->on('heritages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_heritages');
    }
};
