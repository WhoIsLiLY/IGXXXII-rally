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
        Schema::create('tupal_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('img_name')->nullable();
            $table->string('answer', 1);
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->string('e');
            $table->integer('point');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tupal_questions');
    }
};
