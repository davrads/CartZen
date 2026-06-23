<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->schema([
                        Select::make('vendor_id')
                            ->relationship('vendor', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('name')
                            ->required(),

                        TextInput::make('slug')
                            ->required(),

                        Textarea::make('description')
                            ->columnSpanFull(),

                        TextInput::make('brand'),

                        TextInput::make('sku')
                            ->label('SKU'),

                        TextInput::make('price')
                            ->numeric()
                            ->required(),

                        TextInput::make('discounted_price')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('stock')
                            ->numeric()
                            ->required(),

                        FileUpload::make('thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('products/thumbnails'),

                        Select::make('status')
                            ->options([
                                'available' => 'Available',
                                'out_of_stock' => 'Out of Stock',
                            ])
                            ->default('available')
                            ->required(),

                        Toggle::make('featured')
                            ->default(false),
                    ])
                    ->columns(2),

                Section::make('Product Gallery')
                    ->schema([
                        Repeater::make('images')
                        ->relationship()
                        ->schema([
                            FileUpload::make('product_image')
                                ->image()
                                ->disk('public')
                                ->directory('products/gallery')
                                ->required(),
                                
                        ]),

                    ]),

                    Section::make('Product Variants')
                    ->schema([
                        Repeater::make('variants')
                        ->relationship()
                        ->schema([
                            TextInput::make('color')
                                ->required(),

                            TextInput::make('size')
                                ->required(),

                            TextInput::make('price')
                                ->numeric()
                                ->required(),

                            TextInput::make('stock')
                                ->numeric()
                                ->required(),
                        ])
                        ->columns(2),
                    ]),

            ]);
    }
}
