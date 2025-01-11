<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\Product\ProductInterface;

class ProductRepository implements ProductInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        return $this->product->with('product_variants.variant_values')->get();
    }

    public function allPages($perPage)
    {
        return $this->product->with('product_variants.variant_values')->paginate($perPage);
    }
    private function extractProductData($data)
    {
        return [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
            'previous_price' => $data['previous_price'] ?? null,
            'discount_price' => $data['discount_price'] ?? null,
            'has_variant' => $data['has_variant'] ?? false,
            'sku' => $data['sku'] ?? null,
            'stock' => $data['stock'] ?? null,
            'image' => $data['image'] ?? null,
            'gallery_images' => $data['gallery_images'] ?? null,
            'is_active' => $data['is_active'] ?? true,
        ];
    }
    private function handleVariants(Product $product, array $variants)
    {
        foreach ($variants as $variantData) {
            $variant = $product->variants()->create([
                'name' => $variantData['name'],
                'slug' => $variantData['slug'],
            ]);

            if (isset($variantData['values'])) {
                foreach ($variantData['values'] as $valueData) {
                    $variant->values()->create([
                        'value' => $valueData['value'],
                        'sku' => $valueData['sku'],
                        'price' => $valueData['price'] ?? null,
                        'stock' => $valueData['stock'] ?? 0,
                    ]);
                }
            }
        }
    }
    public function store($data)
    {
        DB::beginTransaction();

        try {
            $product = $this->product->create($this->extractProductData($data));

            if ($product->has_variant && isset($data['product_variants'])) {
                $this->handleVariants($product, $data['product_variants']);
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $product = $this->product->findOrFail($id);
            $product->update($this->extractProductData($data));

            if ($product->has_variant && isset($data['product_variants'])) {
                $product->variants()->delete();
                $this->handleVariants($product, $data['product_variants']);
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        return true;
    }

    public function show($id)
    {
        return $this->product->with('product_variants.variant_values')->findOrFail($id);
    }

    public function status($id)
    {
        $product = $this->product->findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        return $product;
    }

}
