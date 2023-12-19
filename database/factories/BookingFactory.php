<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ParkingSpace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $from_date = $this->faker->dateTimeBetween('now', '+3 months');
        $to_date = $this->faker->dateTimeBetween($from_date->format('Y-m-d'), Carbon::parse($from_date)->add('15 days'));

        return [
            'vehicle_id' => $this->faker->numberBetween(1,10),
            'parking_space_id' => $this->faker->numberBetween(1, ParkingSpace::count()),
            'booked_by_id' => $this->faker->numberBetween(1, User::count()),
            'from_date' => $from_date,
            'to_date' => $to_date,
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'cancelled']),
        ];
    }
}
