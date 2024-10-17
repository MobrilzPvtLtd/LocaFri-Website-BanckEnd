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
        Schema::create('contractsout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained()->unique()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('email')->nullable();
            $table->integer('record_kilometers')->nullable();
            $table->integer('fuel_level')->nullable();
            $table->json('vehicle_images')->nullable();
            $table->text('vehicle_damage_comments')->nullable();
            $table->text('customer_signature')->nullable();
            $table->string('odometer_image')->nullable(); // Add odometer_image column
            $table->tinyInteger('is_view')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractsout');
    }
};
