<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentOrders extends TableWidget
{
    protected static ?string $heading = 'Recent Orders';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()->limit(10)
            )

            ->columns([

                TextColumn::make('id')
                    ->label('Order'),

                TextColumn::make('customer.name')
                    ->label('Customer'),

                TextColumn::make('total_amount')
                    ->money('NPR'),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->since(),
            ]);
    }
}
