<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class InventoryAlerts extends TableWidget
{
    protected static ?string $heading = 'Inventory Alerts';

    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(

                Product::query()

                    ->where('vendor_id', Filament::auth()->id())

                    ->where('stock', '<=', 10)

                    ->orderBy('stock')

            )

            ->columns([

                TextColumn::make('name'),

                TextColumn::make('stock'),

                BadgeColumn::make('status'),

            ]);
    }
}