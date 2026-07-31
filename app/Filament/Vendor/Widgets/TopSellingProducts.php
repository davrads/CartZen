<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class TopSellingProducts extends TableWidget
{
    protected static ?string $heading = 'Top Selling Products';

    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderItem::query()
                    ->selectRaw('
                        product_id,
                        SUM(quantity) as sold,
                        SUM(price * quantity) as revenue
                    ')
                    ->where('vendor_id', Filament::auth()->id())
                    ->where('status', 'delivered')
                    ->groupBy('product_id')
                    ->with('product')
                    ->orderByDesc('sold')
            )

            ->columns([
                ImageColumn::make('product.thumbnail'),

                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable(),

                TextColumn::make('sold')
                    ->label('Units Sold'),

                TextColumn::make('revenue')
                    ->money('NPR'),

                TextColumn::make('product.stock')
                    ->label('Current Stock'),

            ]);
    }
}