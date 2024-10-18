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
        Schema::table('contractsout', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->nullable()->after('contract_id'); // Add booking_id column
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade'); // Set foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contractsout', function (Blueprint $table) {
            $table->dropForeign(['booking_id']); // Drop the foreign key
            $table->dropColumn('booking_id');    // Drop the booking_id column
        });
    }
};
