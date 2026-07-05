<?php

namespace App\Filament\Admin\Resources\VendorApplications\Pages;

use App\Filament\Admin\Resources\VendorApplications\VendorApplicationResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditVendorApplication extends EditRecord
{
    protected static string $resource = VendorApplicationResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $oldStatus = $record->status;

        DB::transaction(function () use ($record, $data, $oldStatus) {
            $record->update($data);
        });


        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}