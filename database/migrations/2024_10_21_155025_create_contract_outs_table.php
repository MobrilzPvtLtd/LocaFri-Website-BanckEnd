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
        Schema::create('contract_outs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contract_id')->constrained()->unique()->onDelete('cascade');
            // $table->bigInteger('booking_id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('email')->nullable();
            $table->string('license_photo')->nullable();
            $table->string('record_kilometers')->nullable();
            $table->string('fuel_level')->nullable();
            $table->longText('vehicle_images')->nullable();
            $table->text('vehicle_damage_comments')->nullable();
            $table->text('customer_signature')->nullable();
            $table->string('fuel_image')->nullable();
            $table->boolean('is_view')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_outs');
    }
};
