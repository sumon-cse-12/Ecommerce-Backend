<?php

namespace Database\Seeders;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use App\Models\ProductVariantValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(100)->create()->each(function ($product) {
            if ($product->has_variant) {
                $variantsCount = rand(2, 5);
                $variants = ProductVariant::factory($variantsCount)->create([
                    'product_id' => $product->id,
                ]);

                $variants->each(function ($variant) {
                    $valuesCount = rand(2, 4);
                    ProductVariantValue::factory($valuesCount)->create([
                        'product_variant_id' => $variant->id,
                    ]);
                });
            } else {
               
            }
        });
    }
}
