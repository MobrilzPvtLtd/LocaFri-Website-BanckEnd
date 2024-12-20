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
            $table->string('name',255)->nullable();
            $table->string('model',255)->nullable();
            $table->string('type',255)->nullable();
            $table->longText('desc')->nullable();
            $table->string('location')->nullable();
            $table->decimal('mitter',10,2)->nullable();
            $table->string('image')->nullable();
            $table->string('body')->nullable();
            $table->string('seat')->nullable();
            // $table->string('door')->nullable();
            $table->integer('door')->nullable();
            $table->string('luggage')->nullable();
            $table->string('fuel')->nullable();
            $table->string('auth')->nullable();
            $table->string('trans')->nullable();
            $table->string('exterior')->nullable();
            $table->string('interior')->nullable();
            $table->boolean('featured')->default(0)->nullable();
            $table->text('features')->nullable();
            $table->string('slug')->nullable();
            $table->decimal('Dprice',10,2);
            $table->decimal('wprice',10,2);
            $table->decimal('mprice',10,2);
            $table->timestamp('available_time')->nullable();
            $table->boolean('status')->default(0)->nullable();


            $table->integer('permitted_kilometers_day')->default(200);
            $table->integer('permitted_kilometers_week')->default(1000);
            $table->integer('permitted_kilometers_month')->default(3000);


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
