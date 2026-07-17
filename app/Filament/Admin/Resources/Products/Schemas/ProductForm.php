<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

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
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, $set) =>
                                $operation === 'create'
                                    ? $set('slug', Str::slug($state))
                                    : null
                            ),

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

                        TextInput::make('discounted_price')
                            ->numeric()
                            ->prefix('Rs.')
                            ->label('Discounted Price'),

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

                    ])
                    ->columns(2),

                Section::make('Marketing')
                    ->schema([

                        Toggle::make('featured')
                            ->label('Featured Product')
                            ->default(false),

                        Toggle::make('is_flash_deal')
                            ->label('Flash Deal')
                            ->live(),

                        DateTimePicker::make('flash_deal_ends_at')
                            ->label('Flash Deal Ends At')
                            ->visible(fn ($get) => $get('is_flash_deal'))
                            ->required(fn ($get) => $get('is_flash_deal')),

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