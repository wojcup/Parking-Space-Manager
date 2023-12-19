<?php

namespace Database\Seeders;

use App\Models\ParkingPrice;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParkingPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParkingPrice::create([
            'day_type' => 'weekday',
            'season' => 'summer',
            'price' => '5.20',
        ]);

        ParkingPrice::create([
            'day_type' => 'weekday',
            'season' => 'winter',
            'price' => '5.90',
        ]);

        ParkingPrice::create([
            'day_type' => 'weekend',
            'season' => 'summer',
            'price' => '5.45',
        ]);

        ParkingPrice::create([
            'day_type' => 'weekend',
            'season' => 'winter',
            'price' => '6.15',
        ]);

        ParkingPrice::create([
            'day_type' => 'bank_holiday',
            'season' => 'summer',
            'price' => '10.18',
        ]);

        ParkingPrice::create([
            'day_type' => 'bank_holiday',
            'season' => 'summer',
            'price' => '10.44',
        ]);
    }
}
