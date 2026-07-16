<?php

namespace App\Observers;

use App\Models\OrderItem;

class OrderItemObserver
{
    /**
     * Handle the OrderItem "created" event.
     */
    public function created(OrderItem $orderItem): void
    {
        //
    }

    /**
     * Handle the OrderItem "updated" event.
     */
    public function updated(OrderItem $orderItem): void
    {
        $order = $orderItem->order;

        if(! $order){
            return;
        }

        $statuses = $order->items()
        ->pluck('status')
        ->toArray();

         // 1. All cancelled
        if (count(array_unique($statuses)) === 1 && $statuses[0] === 'cancelled') {

            $order->update([
                'status' => 'cancelled',
            ]);

            return;
        }

        // 2. All delivered
        if (count(array_unique($statuses)) === 1 && $statuses[0] === 'delivered') {

            $order->update([
                'status' => 'delivered',
            ]);

            return;
        }

        // 3. At least one shipped
        if (in_array('shipped', $statuses)) {

            $order->update([
                'status' => 'shipped',
            ]);

            return;
        }

        // 4. At least one processing
        if (in_array('processing', $statuses)) {

            $order->update([
                'status' => 'processing',
            ]);

            return;
        }

        // 5. Otherwise pending
        $order->update([
            'status' => 'pending',
        ]);
    }

    /**
     * Handle the OrderItem "deleted" event.
     */
    public function deleted(OrderItem $orderItem): void
    {
        //
    }

    /**
     * Handle the OrderItem "restored" event.
     */
    public function restored(OrderItem $orderItem): void
    {
        //
    }

    /**
     * Handle the OrderItem "force deleted" event.
     */
    public function forceDeleted(OrderItem $orderItem): void
    {
        //
    }
}
