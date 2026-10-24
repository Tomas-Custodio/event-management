<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('now', '+1 month');
        $end = fake()->dateTimeBetween($start, '+2 months');

        return [
                'name' => fake()->name(),
                'description' => fake()->text(),
                'user_id' => User::factory(),
                'start_time' => fake()->dateTimeBetween('now', '+1 month'),
                'end_time' => fake()->dateTimeBetween('+1 month', '+2 month'),
        ];
    }
}