<?php

namespace App\Filament\Admin\Resources\VendorProfiles\Pages;

use App\Filament\Admin\Resources\VendorProfiles\VendorProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVendorProfile extends EditRecord
{
    protected static string $resource = VendorProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
