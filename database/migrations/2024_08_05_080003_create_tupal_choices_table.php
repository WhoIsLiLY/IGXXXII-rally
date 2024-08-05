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
        Schema::create('tupal_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_tupal_id');
            $table->foreign('soal_tupal_id')
                ->references('id')
                ->on('tupal_questions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('letter');
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tupal_choices');
    }
};
