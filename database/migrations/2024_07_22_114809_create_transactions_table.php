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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('currency')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('date_time')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_paid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
