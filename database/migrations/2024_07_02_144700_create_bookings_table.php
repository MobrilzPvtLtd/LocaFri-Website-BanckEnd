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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('Dprice')->nullable();
            $table->string('wprice')->nullable();
            $table->string('mprice')->nullable();
            $table->string('pickUpLocation')->nullable();
            $table->string('dropOffLocation')->nullable();
            $table->string('pickUpDate')->nullable();
            $table->string('pickUpTime')->nullable();
            $table->string('collectionDate')->nullable();
            $table->string('collectionTime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
