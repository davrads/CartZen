<?php

namespace App\Filament\Vendor\Resources\Inventories\Pages;

use App\Filament\Vendor\Resources\Inventories\InventoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInventory extends ViewRecord
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [

            EditAction::make()
                ->label('Adjust Inventory'),

        ];
    }

    public function getTitle(): string
    {
        return 'Inventory Details';
    }
}