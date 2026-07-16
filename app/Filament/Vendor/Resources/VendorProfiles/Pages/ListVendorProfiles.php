<?php

namespace App\Filament\Vendor\Resources\VendorProfiles\Pages;

use App\Filament\Vendor\Resources\VendorProfiles\VendorProfileResource;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;

class ListVendorProfiles extends ListRecords
{
    protected static string $resource = VendorProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

   
}
