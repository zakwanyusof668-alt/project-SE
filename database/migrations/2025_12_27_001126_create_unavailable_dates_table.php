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
      Schema::create('unavailable_dates', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('venue_id');
        $table->date('date');
        $table->timestamps();
        $table->unique(['venue_id', 'date']);
        $table->foreign('venue_id')
              ->references('id')
              ->on('venues')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unavailable_dates');
    }
};
