<?php

namespace App\Filament\Admin\Resources\FlashSales\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FlashSaleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Flash Sale Information')
                    ->schema([

                        Select::make('product_id')
                            ->label('Product')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('flash_price')
                            ->label('Flash Price')
                            ->numeric()
                            ->prefix('Rs.')
                            ->required(),

                        DateTimePicker::make('start_date')
                            ->label('Starts At')
                            ->seconds(false)
                            ->required(),

                        DateTimePicker::make('end_date')
                            ->label('Ends At')
                            ->seconds(false)
                            ->required()
                            ->after('start_date'),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                    ])
                    ->columns(2),

            ]);
    }
}