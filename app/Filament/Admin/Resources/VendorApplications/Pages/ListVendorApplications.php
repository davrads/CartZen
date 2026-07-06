<?php

namespace App\Filament\Admin\Resources\VendorApplications\Pages;

use App\Filament\Admin\Resources\VendorApplications\VendorApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVendorApplications extends ListRecords
{
    protected static string $resource = VendorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
