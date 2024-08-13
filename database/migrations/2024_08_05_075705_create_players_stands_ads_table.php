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
        Schema::create('players_stands_ads', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id'); // Foreign key ke tabel players
            $table->unsignedBigInteger('stand_ad_id'); // Foreign key ke tabel tupal_questions
            
            $table->primary(['player_id', 'stand_ad_id']);

            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('stand_ad_id')
                ->references('id')
                ->on('stands_ads')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players_stands_ads');
    }
};
