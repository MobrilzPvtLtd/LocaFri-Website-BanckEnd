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
    Schema::create('vehiclestatuses', function (Blueprint $table) {  // Change from 'vehiclestatus' to 'vehiclestatuses'
        $table->id();
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        $table->string('kilometer');
        $table->string('fule');
        $table->string('damage');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiclestatus');
    }
};
