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
        Schema::create('kl_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kl_question_id');
            $table->foreign('kl_question_id')
                ->references('id')
                ->on('kl_questions')
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
        Schema::dropIfExists('kl_choices');
    }
};
