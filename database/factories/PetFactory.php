<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'pet_status' => fake()->randomElement(['enquiry','inbound','cremation','completed','hold']),
            'date_of_call' => fake()->dateTimeBetween('-1 year', 'now'),
            'species' => fake()->randomElement(['dog','cat','rabbit','duck','cow']),
            'age' => fake()->numberBetween(1,20),
            'date_of_birth' => fake()->dateTime(),
            'owner_name' => fake()->name(),
            'is_cremated' => false,
        ];
    }
}
