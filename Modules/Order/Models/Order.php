<?php

namespace Modules\Order\Models;

use App\Models\BaseModel;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Order\Models\OrderDetail;
use Illuminate\Support\Str;

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

     // Define the relationship with the Invoice model
     public function invoice()
     {
         return $this->hasOne(Invoice::class);
     }
 
     // You can also define an event listener in the model
     protected static function booted()
     {
        static::creating(function ($order) {
            $order->Order_number = 'ORDER-' . Str::padLeft(rand(1, 99999), 5, '0'); 
        });
         static::created(function ($order) {
            $order->createInvoice();
         });
     }
 
     // Method to create an invoice
     public function createInvoice()
     {
         // Assuming you want to use default values for the invoice
         $this->invoice()->create([
             'user_id' => $this->CustomerID, // Adjust according to your fields
             'invoice_number' => 'INV-' . strtoupper(uniqid()),
             'invoice_date' => now(),
             'due_date' => now()->addDays(30),
             'subtotal' => $this->TotalAmount, // Example: total from the order
             'tax' => 0, // Example: 10% tax
             'total' => $this->TotalAmount, // Example: total with tax
             'notes' => 'Invoice for Order #' . $this->id,
             'status' => 'draft',
         ]);
     }

     


}
