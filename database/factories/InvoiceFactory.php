<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => function () {
                return \App\Models\Customer::inRandomOrder()->first()->id;
            },
            'invoice_date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 0, 10000), // Generate a random decimal between 0 and 10000
            'status' => $this->faker->randomElement(['unpaid', 'paid', 'cancelled']), // Randomly select a status
        ];
    }
}
