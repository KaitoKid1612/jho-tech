<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'contact_id' => Contact::inRandomOrder()->first()->id ?? Contact::factory(),
            'title' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['new', 'in_progress', 'won', 'lost']),
            'amount' => $this->faker->randomFloat(2, 1000, 50000),
        ];
    }
}
