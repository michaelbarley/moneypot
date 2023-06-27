<?php

namespace Database\Factories;

use App\Models\Pot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contribution>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'pot_id' => Pot::all()->random()->id,
            'amount' => 350.00,
            'reference' => $this->faker->name(),
            'addition_or_withdrawal' => 'add',
        ];
    }
}
