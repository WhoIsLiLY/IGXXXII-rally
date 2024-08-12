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
        Schema::create('stands_ads', function (Blueprint $table) {
            $table->id();
<<<<<<< Updated upstream
            $table->string('nama');
=======
            $table->string('name');
>>>>>>> Stashed changes
            $table->enum('type', ['Stand', 'Ads']);
            $table->float('probability');
            $table->float('base_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stands_ads');
    }
};
