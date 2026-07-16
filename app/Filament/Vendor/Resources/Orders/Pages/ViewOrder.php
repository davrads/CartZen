<?php

namespace App\Filament\Vendor\Resources\CustomerOrders\Pages;

use App\Filament\Admin\Resources\Orders\OrderResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomerOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}