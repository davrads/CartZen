<?php

namespace App\Filament\Vendor\Resources\Inventories\Pages;

use App\Filament\Vendor\Resources\Inventories\InventoryResource;
use Filament\Resources\Pages\EditRecord;

class EditInventory extends EditRecord
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Inventory updated successfully.';
    }

    public function getTitle(): string
    {
        return 'Adjust Inventory';
    }
}