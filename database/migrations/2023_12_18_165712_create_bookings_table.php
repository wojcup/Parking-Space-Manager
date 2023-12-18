<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('parking_space_id')->constrained('parking_spaces');
            $table->foreignId('booked_by_id')->constrained('users');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->enum('status', ['active','cancelled'])->default('active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->unique(['vehicle_id', 'from_date', 'to_date', 'parking_space_id'], 'unique_booking_per_space');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings', function(Blueprint $table){
            $table->dropForeign('bookings_vehicle_id_foreign');
            $table->dropForeign('bookings_parking_space_id_foreign');
        });
    }
};
