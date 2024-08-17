<?php

namespace Modules\OrderSheet\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Order\Models\OrderDetail;
use Modules\BaseMaterial\Models\BaseMaterial;
use Illuminate\Support\Facades\DB;

class OrderSheet extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ordersheets';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\OrderSheet\database\factories\OrderSheetFactory::new();
    }

    /**
     * Get the user that created the base material.
     */
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
    public function helper()
    {
        return $this->belongsTo(User::class, 'helper_id');
    }
    public function orderItem()
    {
        return $this->belongsTo(OrderDetail::class, 'order_item_id');
    }
    public function baseMaterial()
    {
        return $this->belongsTo(BaseMaterial::class, 'base_material_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($ordersheet) {
            // Only check status updates for 'packed' state

            if ($ordersheet->status == 'packed') {
                DB::table('order_details')
                    ->where('id', $ordersheet->order_item_id)
                    ->update(['Status' => 'Ready To Ship']);
                // Check if all related order items are 'Ready To Ship'

                $orderSummary = DB::table('order_details')
                    ->selectRaw('SUM(status = "Ready To Ship") as ready_to_ship_count, COUNT(*) as total_count')
                    ->where('OrderID', $ordersheet->orderItem->OrderID)
                    ->first();

                // Check if all related order items are 'Ready To Ship'
                if ($orderSummary->ready_to_ship_count == $orderSummary->total_count) {
                    // Update the order status to 'Ready To Ship'
                    DB::table('orders')
                        ->where('id', $ordersheet->orderItem->OrderID)
                        ->update(['Status' => 'Ready To Ship']);
                }
            }

            if ($ordersheet->status == 'filled') {
                DB::table('orders')
                    ->where('id', $ordersheet->orderItem->OrderID)
                    ->update(['Status' => 'Processing']);

                //     DB::table('order_details')
                //         ->where('id', $ordersheet->order_item_id)
                //         ->update(['Status' => 'Ready To Ship']);
                //     // Check if all related order items are 'Ready To Ship'

                //     $orderSummary = DB::table('order_details')
                //         ->selectRaw('SUM(status = "Ready To Ship") as ready_to_ship_count, COUNT(*) as total_count')
                //         ->where('OrderID', $ordersheet->orderItem->OrderID)
                //         ->first();

                //     // Check if all related order items are 'Ready To Ship'
                //     if ($orderSummary->ready_to_ship_count == $orderSummary->total_count) {
                //         // Update the order status to 'Ready To Ship'
                //         DB::table('orders')
                //             ->where('id', $ordersheet->orderItem->OrderID)
                //             ->update(['Status' => 'Ready To Ship']);
                //     }
            }
        });
    }
}
