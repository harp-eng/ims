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
            $module_name_singular = OrderSheet::create([
                'order_item_id' => $orderDetail->id,
                'name' => 'Work Sheet '.$orderDetail->id,
                // Add other relevant data here
            ]);
            $changes=$module_name_singular;
            $module_title='Order Sheet';
            $module_action='Created';
            activity()
            ->performedOn($module_name_singular)
            ->when(isset($changes) && !empty($changes), function ($activity) use ($changes) {
                $activity->withProperties(['changes' => $changes]);
            })
            ->event($module_title . ' ' . $module_action)
            ->log($module_title . ' ' . $module_action.' => '.$module_title.' name: '.$module_name_singular->name. ' on order create.');
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
