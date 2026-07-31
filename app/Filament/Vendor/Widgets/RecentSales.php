<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentSales extends TableWidget
{
    protected static ?string $heading = 'Recent Sales';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(

                OrderItem::query()

                    ->where('vendor_id', Filament::auth()->id())

                    ->with(['order.customer', 'product'])

                    ->latest()

            )

            ->columns([

                TextColumn::make('order.order_number')
                    ->label('Order'),

                TextColumn::make('order.customer.name')
                    ->label('Customer'),

                TextColumn::make('product.name')
                    ->limit(30),

                TextColumn::make('quantity'),

                TextColumn::make('price')
                    ->money('NPR'),

                BadgeColumn::make('status'),

                TextColumn::make('created_at')
                    ->since(),

            ]);
    }
}