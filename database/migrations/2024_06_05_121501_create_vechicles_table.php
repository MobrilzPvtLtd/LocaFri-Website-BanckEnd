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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('type');
            $table->string('desc');
            $table->string('location');
            $table->string('mitter');
            $table->string('image');
            $table->string('body');
            $table->string('seat');
            $table->string('door');
            $table->string('luggage');
            $table->string('fuel');
            $table->string('auth');
            $table->string('trans');
            $table->string('exterior');
            $table->string('interior');
            $table->boolean('featured');
            $table->string('features');
            $table->string('slug');
            $table->boolean('Dprice');
            $table->string('wprice');
            $table->string('mprice');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
