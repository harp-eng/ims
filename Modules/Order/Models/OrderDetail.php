<?php

namespace Modules\Order\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\Product;

class OrderDetail extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'order_details';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Order\database\factories\OrderDetailFactory::new();
    }

    /**
     * Get the user that created the base material.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
