<?php

namespace App\Filament\Admin\Resources\FlashSales\Pages;

use App\Filament\Admin\Resources\FlashSales\FlashSaleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFlashSale extends EditRecord
{
    protected static string $resource = FlashSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
