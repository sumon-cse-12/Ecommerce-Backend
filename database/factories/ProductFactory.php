<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $this->faker->paragraph,
            'previous_price' => $this->faker->randomFloat(2, 20, 500),
            'discount_price' => $this->faker->randomFloat(2, 10, 300),
            'has_variant' => $this->faker->boolean(50),
            'sku' => $this->faker->unique()->bothify('SKU-#####'),
            'stock' => $this->faker->numberBetween(0, 1000),
            'image' => $this->faker->imageUrl(640, 480, 'product', true),
            'gallery_images' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl()]),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
