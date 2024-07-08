<?php

namespace App\Observers;

use Modules\Order\Models\OrderDetail;
use Modules\OrderSheet\Models\OrderSheet;
use Illuminate\Support\Facades\Log;

class OrderDetailObserver
{
    /**
     * Handle the OrderDetail "created" event.
     */
    public function created(OrderDetail $orderDetail)
    {
        if ($orderDetail->status == 'Pending') {
            OrderSheet::create([
                'order_item_id' => $orderDetail->id,
                'name' => 'Work Sheet '.$orderDetail->id,
                // Add other relevant data here
            ]);
        }
    }

    /**
     * Handle the OrderDetail "updated" event.
     */
    public function updated(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "deleted" event.
     */
    public function deleted(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "restored" event.
     */
    public function restored(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "force deleted" event.
     */
    public function forceDeleted(OrderDetail $orderDetail): void
    {
        //
    }
}
