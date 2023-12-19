<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->randomElement(['Audi', 'VW', 'Tesla', 'Volvo', 'Citroen', 'Peugeot', 'Ferrari', 'Subaru']),
            'model' => $this->faker->randomElement(['A3', 'A4', 'A8', 'Q3', 'Golf', 'Jetta', 'XC60', 'Impreza']),
            'plate_number' => $this->faker->bothify('??##???'),
            'owner_id' =>  $this->faker->numberBetween(1,5),
        ];
    }
}
