<?php

namespace Modules\Transaction\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Modules\Order\Models\Order;

class Transaction extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transactions';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Transaction\database\factories\TransactionFactory::new();
    }

      // Define the relationship back to Order
      public function order()
      {
          return $this->belongsTo(Order::class);
      }
  
      // Define the relationship back to Order
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
