<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pot>
 */
class PotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::all()->random()->id,
            'description' => $this->faker->name(),
            'is_private' => null,
            'amount' => 350.00,
            'status' => 'open',
            'goal' => 500.00,
            'is_auto_closing' => 0,
            'is_private' => 0,
            'accent_colour' => 'pink',
        ];
    }
}
