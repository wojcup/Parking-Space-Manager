<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingSpace>
 */
class ParkingSpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => $this->generateLabel(),
            'description' => $this->faker->text(),
            'status' =>  $this->faker->randomElement(['available', 'available', 'available', 'available', 'available', 'reserved', 'out of order', 'maintenance']),
        ];
    }


    private function generateLabel(){
        $prefix = 'Space_';
        $suffix = sprintf( "%03d", rand( 1, 10 ) );
        return $prefix.$suffix;
    }
}
