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
        Schema::create('price_queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_space_id')->constrained('parking_spaces');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->integer('no_of_week_days')->nulable();
            $table->unsignedDecimal('week_days_price', 10, 2)->nullable();
            $table->integer('no_of_weekend_days')->nulable();
            $table->unsignedDecimal('weekend_days_price', 10, 2)->nullable();
            $table->integer('no_of_holiday_days')->nulable();
            $table->unsignedDecimal('holiday_days_price', 10, 2)->nullable();
            $table->unsignedDecimal('total_to_pay', 10, 2)->nullable();
            $table->foreignId('bookings_id')->constrained('bookings');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_queries');
    }
};
