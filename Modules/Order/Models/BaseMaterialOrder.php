<?php

namespace Modules\Order\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BaseMaterial\Models\BaseMaterial;
use Modules\Order\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class BaseMaterialOrder extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'base_material_orders';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Order\database\factories\BaseMaterialOrdersFactory::new();
    }

    /**
     * Boot method to add model event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($baseMaterialOrder) {
            // Update Order QuantityInStock and leftQuantity when a new record is created
            $order = $baseMaterialOrder->baseMaterial;
            if ($order) {
                $order->QuantityUsed += $baseMaterialOrder->QuantityUsed;

                // Calculate leftQuantity
                $leftQuantity = $order->QuantityProduced - $order->QuantityUsed;

                $order->QuantityInStock = $leftQuantity;
                $order->save();
                
                DB::table('base_material_orders')
                ->where('id', $baseMaterialOrder->id)
                ->update(['LeftQuantity' => $leftQuantity]);
            }
        });

        static::updated(function ($baseMaterialOrder) {
            // Update Order QuantityInStock and leftQuantity when a record is updated
            $original = $baseMaterialOrder->getOriginal();
            $order = $baseMaterialOrder->baseMaterial;
            if ($order) {
                // Ensure QuantityUsed exists in the original attributes
                $originalQuantityUsed = isset($original['QuantityUsed']) ? $original['QuantityUsed'] : 0;
                $st_used=$baseMaterialOrder->QuantityUsed - $originalQuantityUsed;
                // Adjust QuantityUsed based on the change in QuantityUsed
                $order->QuantityUsed += $st_used;

                // Calculate leftQuantity
                $leftQuantity = $order->QuantityProduced - $order->QuantityUsed;

                $order->QuantityInStock = $leftQuantity;
                $order->save();

                DB::table('base_material_orders')
                ->where('id', $baseMaterialOrder->id)
                ->update(['LeftQuantity' => $leftQuantity]);
            }
        });
    }

    /**
     * Get the order associated with the base material order.
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderDetail::class, 'orderDetailID');
    }

    /**
     * Get the base material associated with the base material order.
     */
    public function baseMaterial()
    {
        return $this->belongsTo(BaseMaterial::class, 'BaseMaterialID');
    }
}
