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
        Schema::create('debts', function (Blueprint $table) {
            $table->id(); //biar player bisa mengambil opsi utang yang sama berkali2

            $table->foreignId('player_id');
            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('debt_option_id');
            $table->foreign('debt_option_id')
                ->references('id')
                ->on('debt_options')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('interest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
