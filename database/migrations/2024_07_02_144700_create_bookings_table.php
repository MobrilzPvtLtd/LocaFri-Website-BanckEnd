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
            $table->decimal('Dprice',10,2)->nullable();
            $table->decimal('wprice',10,2)->nullable();
            $table->decimal('mprice',10,2)->nullable();
            $table->decimal('total_price',10,2)->nullable();
            $table->decimal('day_count',10,2)->nullable();
            $table->decimal('week_count',10,2)->nullable();
            $table->decimal('month_count',10,2)->nullable();
            $table->decimal('additional_driver',10,2)->nullable();
            $table->decimal('booster_seat',10,2)->nullable();
            $table->decimal('child_seat',10,2)->nullable();
            $table->decimal('exit_permit',10,2)->nullable();
            $table->decimal('pickUpLocation')->nullable();
            $table->string('dropOffLocation')->nullable();
            $table->string('pickUpDate')->nullable();
            $table->string('pickUpTime')->nullable();
            $table->string('collectionTime')->nullable();
            $table->string('collectionDate')->nullable();
            $table->string('targetDate')->nullable();
            $table->string('status')->default('pending')->nullable();
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
