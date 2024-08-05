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
        Schema::create('roads', function (Blueprint $table) {
            $table->foreignId('origin_id');
            $table->foreign('origin_id')
            ->references('id')
            ->on('cities')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('destination_id');
            $table->foreign('destination_id')
            ->references('id')
            ->on('cities')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('distance');
            $table->integer('speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roads');
    }
};
