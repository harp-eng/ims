<?php

namespace Modules\Product\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Product\database\factories\ProductFactory::new();
    }
    protected static function booted()
    {
        static::creating(function ($product) {
            // Generate SKU, you can adjust this logic as needed
            $product->SKU = 'SKU-' . Str::padLeft(rand(1, 99999), 5, '0');
        });
    }
}
