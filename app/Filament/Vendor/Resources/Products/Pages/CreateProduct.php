<?php

namespace App\Filament\Vendor\Resources\Products\Pages;

use App\Filament\Vendor\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['vendor_id'] = Auth::user()->id;
        $data['verification_status'] = 'pending';
        $data['verified_by'] = null;
        $data['verified_at'] = null;
        $data['rejection_reason'] = null;
        return $data;
    }
}
