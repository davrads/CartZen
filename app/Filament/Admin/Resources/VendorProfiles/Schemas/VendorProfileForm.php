<?php

namespace App\Filament\Admin\Resources\VendorProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VendorProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->preload(),

                TextInput::make('shop_name')
                    ->required(),

                TextInput::make('shop_slug')
                    ->required(),

                FileUpload::make('shop_logo')
                    ->image()
                    ->directory('vendor_profiles'),

                Textarea::make('description')
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->tel()
                    ->default(null),

                TextInput::make('address')
                    ->default(null),

                TextInput::make('pan_number')
                    ->required(),

                TextInput::make('account_number')
                    ->required(),

                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
