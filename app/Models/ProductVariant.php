<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function variant_values()
    {
        return $this->hasMany(ProductVariantValue::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
