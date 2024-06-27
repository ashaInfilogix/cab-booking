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
        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id');
            $table->integer('brand_id');
            $table->integer('model_id');
            $table->string('registration_number');
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('locations');
            $table->string('car_rc');
            $table->string('car_images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_details');
    }
};
