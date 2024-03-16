<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repair>
 */
class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'in progress', 'completed']),
            'startDate' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'endDate' => $this->faker->dateTimeBetween('now', '+1 year'),
            'mechanicNotes' => $this->faker->paragraph,
            'clientNotes' => $this->faker->paragraph,
            'mechanic_id' => function () {
                return User::factory()->create(['role' => 'mechanic'])->id;
            },
            'vehicle_id' => function () {
                return Vehicle::factory()->create()->id;
            },
        ];
    }
}
