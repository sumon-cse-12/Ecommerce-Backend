<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category_id' => $this->id,
            'category_name' => $this->name,
            'category_slug' => $this->slug,
            'category_image' => $this->image,
            'category_description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_active' => $this->is_active
        ];
    }
}
