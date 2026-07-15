<?php

namespace App\Filament\Admin\Resources\Products\Pages;

use App\Filament\Admin\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function toggleFlashSale($productId)
    {
        $product = Product::whereKey($productId)->first();
        if (!$product || !$product->flashSale) {
            Notification::make()
                ->warning()
                ->title('No flash sale assigned')
                ->send();
            return;
        }

        $flash = $product->flashSale;
        $flash->is_active = !$flash->is_active;
        $flash->save();

        Notification::make()
            ->success()
            ->title('Flash sale ' . ($flash->is_active ? 'activated' : 'deactivated'))
            ->send();
    }
}
