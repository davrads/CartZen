<?php

namespace App\Filament\Vendor\Resources\Inventories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InventoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Section::make('Product Information')
                    ->description('Basic product information.')
                    ->columns(2)
                    ->schema([

                        FileUpload::make('thumbnail')
                            ->label('Product Image')
                            ->disk('public')
                            ->disabled(),

                        TextInput::make('name')
                            ->label('Product Name')
                            ->disabled(),

                        TextInput::make('sku')
                            ->label('SKU')
                            ->disabled(),

                        TextInput::make('brand')
                            ->disabled(),

                        TextInput::make('price')
                            ->prefix('Rs.')
                            ->disabled(),

                        TextInput::make('sale_price')
                            ->label('Sale Price')
                            ->prefix('Rs.')
                            ->disabled(),

                    ]),

               

                Section::make('Inventory')
                    ->description('Manage product stock.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('stock')
                            ->label('Current Stock')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->helperText('Enter available stock quantity.'),

                        Select::make('status')
                            ->options([
                                'available' => 'Available',
                                'out_of_stock' => 'Out of Stock',
                            ])
                            ->required(),

                    ]),


                Section::make('Inventory Summary')
                    ->columns(2)
                    ->schema([

                        Placeholder::make('stock_status')
                            ->label('Stock Status')
                            ->content(function ($record) {

                                if ($record->stock == 0) {
                                    return '🔴 Out of Stock';
                                }

                                if ($record->stock <= 10) {
                                    return '🟠 Low Stock';
                                }

                                return '🟢 In Stock';
                            }),

                        Placeholder::make('last_updated')
                            ->label('Last Updated')
                            ->content(fn ($record) =>
                                $record->updated_at?->diffForHumans()
                            ),

                    ]),

            ]);
    }
}