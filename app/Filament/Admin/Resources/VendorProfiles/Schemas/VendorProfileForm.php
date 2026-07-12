<?php

namespace App\Filament\Vendor\Resources\VendorProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VendorProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Shop Information')
                    ->schema([

                        FileUpload::make('shop_logo')
                            ->image()
                            ->disk('public')
                            ->directory('vendor_profiles'),

                        TextInput::make('shop_name')
                            ->required(),

                        TextInput::make('shop_slug')
                            ->required(),

                        Textarea::make('description')
                            ->columnSpanFull(),

                        TextInput::make('phone')
                            ->tel(),

                        TextInput::make('address'),

                    ])
                    ->columns(2)

            ]);
    }
}