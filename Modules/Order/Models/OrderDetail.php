<?php

namespace Modules\Order\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\Product;
use Modules\Order\Models\Order;
use Illuminate\Support\Facades\DB;


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

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }
    

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($orderdetail) {
            // Only check status updates for 'packed' state
            if ($orderdetail->status === 'packed') {
                // Use a single query to fetch both counts
                $orderSummary = DB::table('order_details')
                    ->selectRaw('SUM(status = "Ready To Ship") as ready_to_ship_count, COUNT(*) as total_count')
                    ->where('OrderID', $orderdetail->OrderID)
                    ->first();

                // Check if all related order items are 'Ready To Ship'
                if ($orderSummary->ready_to_ship_count == $orderSummary->total_count) {
                    // Update the order status to 'Ready To Ship'
                    DB::table('orders')
                        ->where('id', $orderdetail->OrderID)
                        ->update(['Status' => 'Ready To Ship']);
                }
            }
        });
    }
}
