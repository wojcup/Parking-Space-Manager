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
        Schema::create('parking_prices', function (Blueprint $table) {
            $table->id();
            $table->enum('day_type',['weekday','weekend','bank_holiday'])->default('weekday');
            $table->enum('season',['winter','summer'])->default('summer');
            $table->unsignedDecimal('discount', 10, 2)->nullable();
            $table->unsignedDecimal('price', 10, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_prices');
    }
};
