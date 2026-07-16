<?php

namespace App\Filament\Vendor\Resources\VendorProfiles\Pages;

use App\Filament\Vendor\Resources\VendorProfiles\VendorProfileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVendorProfile extends ViewRecord
{
    protected static string $resource = VendorProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}