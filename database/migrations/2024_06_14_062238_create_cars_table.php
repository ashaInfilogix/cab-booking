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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('model_id');
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('color')->nullable();
            $table->string('VIN')->unique()->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->unsignedInteger('mileage')->nullable();
            $table->enum('vehicle_type', ['hatchback', 'sedan', 'suv', 'other']);
            $table->enum('transmission', ['automatic', 'manual']);
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid', 'cng', 'other']);
            $table->unsignedTinyInteger('doors')->nullable(); 
            $table->unsignedTinyInteger('seats')->nullable(); 
            $table->enum('condition', ['average', 'good', 'excellent']);
            $table->text('description')->nullable(); 
            $table->string('image_urls')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
