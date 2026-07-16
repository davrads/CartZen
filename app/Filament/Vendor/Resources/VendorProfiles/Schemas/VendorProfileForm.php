<?php

namespace App\Filament\Vendor\Resources\VendorProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                Section::make('Store Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('shop_name')
                            ->label('Shop Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('shop_slug')
                            ->label('Shop Slug')
                            ->disabled(),

                        Textarea::make('description')
                            ->label('Store Description')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
                Section::make('Contact Information')
                    ->columns(2)
                    ->schema([

                        TextInput::make('email')
                            ->email()
                            ->required(),

                        TextInput::make('phone')
                            ->tel(),

                        Textarea::make('address')
                            ->rows(3)
                            ->columnSpanFull(),

                    ]),

                Section::make('Branding')
                    ->schema([

                        FileUpload::make('shop_logo')
                            ->label('Shop Logo')
                            ->disk('public')
                            ->directory('vendor-logos')
                            ->image()
                            ->imageEditor(),

                    ]),

                Section::make('Verification Details')
                    ->columns(2)
                    ->schema([

                        TextInput::make('pan_number')
                            ->label('PAN Number')
                            ->disabled(),

                        TextInput::make('account_number')
                            ->label('Khalti Account Number')
                            ->placeholder('Enter Khalti Account Number')
                            ->required(),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->disabled(),

                    ]),
            ]);
    }
}
