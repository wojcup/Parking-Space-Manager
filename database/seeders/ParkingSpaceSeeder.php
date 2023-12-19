<?php

namespace Database\Seeders;

use App\Models\ParkingSpace;
use Illuminate\Database\Seeder;
use Database\Factories\ParkingSpaceFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParkingSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParkingSpace::factory()->count(10)->create();
    }
}
