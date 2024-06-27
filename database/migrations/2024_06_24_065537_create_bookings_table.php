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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('contact_number');
            $table->string('user_email');
            $table->string('pick_up');
            $table->string('drop_off');
            $table->integer('passengers');
            $table->string('cab_type')->nullable();
            $table->string('pick_up_date');
            $table->string('pick_up_time');
            $table->string('driver_age')->nullable();
            $table->string('cab_model')->nullable();
            $table->string('driver_assigned')->nullable();
            $table->string('trip_end_date')->nullable();
            $table->enum('booking_status', ['waiting','confirmed', 'completed', 'cancelled'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
