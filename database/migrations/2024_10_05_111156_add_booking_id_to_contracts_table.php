<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->nullable(); // or not nullable based on your requirements
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropColumn('booking_id');
        });
    }
    
};
