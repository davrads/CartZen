<?php
namespace App\Filament\Vendor\Resources\OrderItems\Pages;

use App\Filament\Vendor\Resources\OrderItems\OrderItemResource;
use App\Models\OrderItem;
use Filament\Resources\Pages\EditRecord;

class EditOrderItem extends EditRecord
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function afterSave(): void
    {
        $orderItem = $this->record;

        if (
            $orderItem->status === 'cancelled' &&
            ! $orderItem->inventory_restored &&
            $orderItem->getOriginal('status') !== 'delivered'
        ) {

            $product = $orderItem->product;

            if ($product) {
                $product->increment('stock', $orderItem->quantity);

                $product->status = $product->stock > 0
                    ? 'available'
                    : 'out_of_stock';

                $product->save();
            }

            $orderItem->inventory_restored = true;
            $orderItem->save();
        }

        $this->syncOrderStatus($orderItem);
    }

    protected function syncOrderStatus(OrderItem $orderItem): void
    {
        $order = $orderItem->order;

        if (! $order) {
            return;
        }

        $order->update([
            'status' => $orderItem->status,
        ]);
    }
}