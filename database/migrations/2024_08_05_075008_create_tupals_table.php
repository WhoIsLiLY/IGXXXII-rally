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
        Schema::create('tupals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id');
            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
<<<<<<< HEAD
            $table->integer('point')->default(15000);
            $table->integer('reject')->default(0);
            $table->integer('serve')->default(0);
=======
            $table->integer('point')->default(0);
            $table->integer('reject');
            $table->integer('serve');
>>>>>>> 9f2b323 (add validate score button)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tupals');
    }
};
