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
        Schema::create('tupal_sessions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('open');
            $table->timestamp('close')->nullable();
            $table->enum('boost', [
                '25% Stand Ad Price Reduction',
                'Question Point Boost 25%'
            ])->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tupal_sessions');
    }
};
