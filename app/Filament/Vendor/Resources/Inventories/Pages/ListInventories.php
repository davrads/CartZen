<?php

namespace App\Filament\Vendor\Resources\Inventories\Pages;

use App\Filament\Vendor\Resources\Inventories\InventoryResource;
use Filament\Resources\Pages\ListRecords;

class ListInventories extends ListRecords
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return 'Inventory';
    }

    public function getSubheading(): ?string
    {
        return 'Manage product stock levels and inventory.';
    }
}