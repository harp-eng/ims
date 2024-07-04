<?php

namespace Modules\Order\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Order\Models\OrderDetail;

class Order extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Order\database\factories\OrderFactory::new();
    }

    /**
     * Get the user that created the base material.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'CustomerID');
    }

     /**
     * Get the user that created the base material.
     */
    
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'OrderID', 'id');
    }


}
