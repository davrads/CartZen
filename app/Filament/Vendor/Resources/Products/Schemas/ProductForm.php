<?php

namespace App\Filament\Vendor\Resources\Products\Schemas;

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
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('description')
                            ->columnSpanFull(),

                        TextInput::make('brand'),

                        TextInput::make('sku')
                            ->label('SKU'),

                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('Rs.'),

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
                            ->default('available'),
    
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
                            ])
                            ->collapsible()
                            ->columnSpanFull(),
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

                                TextInput::make('stock')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('Rs.'),
                            ])
                            ->columns(2)
                            ->collapsible(),
                    ]),

            ]);
    }
}
