<?php

namespace App\Filament\Admin\Resources\Products;

use App\Filament\Admin\Resources\Products\Pages\CreateProduct;
use App\Filament\Admin\Resources\Products\Pages\EditProduct;
use App\Filament\Admin\Resources\Products\Pages\ListProducts;
use App\Models\Product;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, $set) =>
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    )
                    ->maxLength(255),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rs.'),

                TextInput::make('discounted_price')
                    ->numeric()
                    ->prefix('Rs.')
                    ->label('Discounted Price (flash deal price)'),

                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),

                // Remove vendor and category fields for now – add later with correct column names
                // Select::make('vendor_id')->relationship('vendor', 'store_name'),
                // Select::make('category_id')->relationship('category', 'name'),

                Toggle::make('featured')
                    ->label('Featured Product')
                    ->default(false),

                Toggle::make('is_flash_deal')
                    ->label('Flash Deal')
                    ->default(false)
                    ->reactive(),

                DateTimePicker::make('flash_deal_ends_at')
                    ->label('Flash Deal Ends At')
                    ->visible(fn ($get) => $get('is_flash_deal'))
                    ->requiredIf('is_flash_deal', true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->label('Image')->square(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('price')->money('INR')->sortable(),
                TextColumn::make('stock')->sortable(),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                IconColumn::make('is_flash_deal')
                    ->label('Flash Deal')
                    ->boolean()
                    ->trueIcon('heroicon-o-bolt')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('flash_deal_ends_at')
                    ->label('Flash End')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('featured')
                    ->label('Featured')
                    ->placeholder('All Products')
                    ->trueLabel('Featured Only')
                    ->falseLabel('Not Featured'),

                TernaryFilter::make('is_flash_deal')
                    ->label('Flash Deal')
                    ->placeholder('All Products')
                    ->trueLabel('On Flash Deal')
                    ->falseLabel('Not on Flash Deal'),
            ])
            // Click any row to edit
            ->recordUrl(fn (Product $record): string => route('filament.admin.resources.products.edit', $record));
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit'   => EditProduct::route('/{record}/edit'),
        ];
    }
}