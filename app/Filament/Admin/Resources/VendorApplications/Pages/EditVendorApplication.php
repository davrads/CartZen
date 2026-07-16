<?php

namespace App\Filament\Admin\Resources\VendorApplications\Pages;

use App\Filament\Admin\Resources\VendorApplications\VendorApplicationResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Mail\VendorApprovedMail;
use App\Mail\VendorRejectedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EditVendorApplication extends EditRecord
{
    protected static string $resource = VendorApplicationResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $oldStatus = $record->status;

        DB::transaction(function () use ($record, $data, $oldStatus) {
            $record->update($data);

            if ($record->status === 'approved' && $oldStatus !== 'approved') {

                $password = Str::password(8);

                $user = User::firstOrcreate([
                    'email' => $record->email,
                ],
                [
                    'name' => $record->owner_name,
                    'password' => Hash::make($password),
                    'role' => 'vendor',
                ]);

                try {
                    VendorProfile::updateOrcreate(
                        [
                        'user_id' => $user->id,
                        ],
                        [
                        'shop_name' => $record->shop_name,
                        'shop_slug' => Str::slug($record->shop_name),
                        'shop_logo' => $record->shop_logo,
                        'description' => $record->description,
                        'phone' => $record->phone,
                        'email' => $record->email,
                        'address' => $record->address,

                        'pan_number' => 'Pending',
                        'account_number' => 'Pending',

                        'status' => 'approved',
                    ]);
                } catch (\Throwable $e) {
                    dd($e->getMessage(), $e->getTraceAsString());
                }

                Mail::to($record->email)->send(
                    new VendorApprovedMail(
                        $record->email,
                        $password,
                        $record->shop_name
                    )
                );
            }
            if (
                $record->status === 'rejected'
                && $oldStatus !== 'rejected'
            ) {

                Mail::to($record->email)->send(
                    new VendorRejectedMail(
                        $record->shop_name,
                        $record->remarks
                    )
                );
            }
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
