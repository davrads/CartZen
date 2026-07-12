<?php

namespace App\Filament\Vendor\Resources\OrderItems\Pages;

use App\Filament\Vendor\Resources\OrderItems\OrderItemResource;
use Filament\Resources\Pages\ViewRecord;

class ViewOrderItem extends ViewRecord
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}