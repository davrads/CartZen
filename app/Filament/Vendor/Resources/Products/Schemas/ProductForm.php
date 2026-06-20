<?php

namespace App\Filament\Vendor\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('vendor_id')
                    ->required()
                    ->numeric(),
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('brand')
                    ->default(null),
                TextInput::make('sku')
                    ->label('SKU')
                    ->default(null),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('discounted_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                FileUpload::make('thumbnail')
                    ->default(null),
                Select::make('status')
                    ->options(['available' => 'Available', 'out_of_stock' => 'Out of stock'])
                    ->default('available')
                    ->required(),
                Toggle::make('featured')
                    ->required(),
            ]);
    }
}
