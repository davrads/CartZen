<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Auth;

class LatestProducts extends TableWidget
{
    protected static ?string $heading = 'Latest Products';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('vendor_id', Auth::id())
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->weight('bold')
                    ->limit(30),

                TextColumn::make('category.name')
                    ->badge(),

                TextColumn::make('price')
                    ->money('NPR')
                    ->sortable(),

                TextColumn::make('stock')
                    ->sortable()
                    ->badge()
                    ->color(fn(int $state) => $state <= 5 ? 'danger' : 'success'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'available' => 'success',
                        'out_of_stock' => 'danger',
                    }),
            ]);
    }
}
