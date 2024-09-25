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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            // $table->string('first_name');
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('email')->nullable();
            $table->string('license_photo')->nullable();
            $table->string('record_kilometers')->nullable();
            $table->tinyInteger('fuel_level')->default(0);
            $table->longText('vehicle_images')->nullable();
            $table->text('vehicle_damage_comments')->nullable();
            $table->text('customer_signature')->nullable();

            // $table->tinyInteger('is_view')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
