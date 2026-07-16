<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentOrders extends BaseWidget
{
    protected static ?string $heading = 'Recent Orders';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return OrderItem::query()
            ->where('vendor_id', Filament::auth()->id())
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [

            Tables\Columns\TextColumn::make('order.order_number')
                ->label('Order')
                ->searchable(),

            Tables\Columns\TextColumn::make('product.name')
                ->label('Product')
                ->limit(30),

            Tables\Columns\TextColumn::make('quantity')
                ->badge(),

            Tables\Columns\TextColumn::make('price')
                ->money('NPR'),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'warning' => 'pending',
                    'info' => 'processing',
                    'primary' => 'shipped',
                    'success' => 'delivered',
                    'danger' => 'cancelled',
                ]),

            Tables\Columns\TextColumn::make('created_at')
                ->since(),

        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    public function getTableRecordsPerPage(): int
    {
        return 5;
    }
}