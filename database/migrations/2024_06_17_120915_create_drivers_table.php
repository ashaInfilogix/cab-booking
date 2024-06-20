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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('license_number')->unique()->nullable();
            $table->string('contact_number')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('location')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('insurance_details')->nullable();
            $table->string('address')->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('driver_status', ['active', 'leave', 'suspended']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
