<?php

namespace Modules\OrderSheet\Models;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Order\Models\OrderDetail;
use Modules\BaseMaterial\Models\BaseMaterial;

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
}
