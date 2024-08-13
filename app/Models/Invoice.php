<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
    protected $fillable = [
        'user_id',          // Add this line
        'invoice_number',
        'invoice_date',
        'due_date',
        'subtotal',
        'tax',
        'total',
        'notes',
        'status',
    ];

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
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($invoice) {
            // Calculate and update QuantityInStock on update without triggering events
            if($invoice->status=='Paid'){
                DB::table('orders')
                ->where('id', $invoice->order_id)
                ->update(['Status' => 'paid']);
            }
        });
    }
}
