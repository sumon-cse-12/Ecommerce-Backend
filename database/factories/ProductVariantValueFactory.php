<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariantValue>
 */
class ProductVariantValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->unique()->words(3, true), // Combine 3 words for uniqueness
            'sku' => $this->faker->unique()->regexify('[A-Z0-9]{8}'), // Generate random unique SKUs
            'price' => $this->faker->randomFloat(2, 1, 100), // Price between 1 and 100
            'stock' => $this->faker->numberBetween(1, 100), // Stock between 1 and 100
        ];
    }
}
