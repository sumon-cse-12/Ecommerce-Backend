<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->id,
            'product_name' => $this->name,
            'product_slug' => $this->slug,
            'product_description' => $this->description,
            'previous_price' => $this->previous_price,
            'discount_price' => $this->discount_price,
            'has_variant' => $this->has_variant,
            'product_sku' => $this->sku,
            'product_stock' => $this->stock,
            'product_image' => $this->image,
            'gallery_images' => $this->gallery_images,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'variants' => $this->product_variants->map(function ($variant) {
                return [
                    'variant_id' => $variant->id,
                    'variant_name' => $variant->name,
                    'variant_slug' => $variant->slug,
                    'variant_values' => $variant->variant_values->map(function ($value) {
                        return [
                            'value_id' => $value->id,
                            'value_name' => $value->value,
                            'sku' => $value->sku,
                            'price' => $value->price,
                            'stock' => $value->stock,
                        ];
                    }),
                ];
            }),
        ];
    }
}
