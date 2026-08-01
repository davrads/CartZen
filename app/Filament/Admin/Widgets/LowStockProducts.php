<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LowStockProducts extends TableWidget
{
    protected static ?string $heading = 'Low Stock Products';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('stock', '<=', 10)
                    ->where('verification_status', 'approved')
                    ->orderBy('stock')
            )

            ->columns([

               ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name'),

                TextColumn::make('vendor.name'),

                TextColumn::make('stock')
                    ->badge()
                    ->color(fn ($state) => $state <= 5 ? 'danger' : 'warning'),

                TextColumn::make('status')
                    ->badge(),
            ]);
    }
}