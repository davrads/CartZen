<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueOverview extends StatsOverviewWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $vendorId = Filament::auth()->id();

        $delivered = OrderItem::where('vendor_id', $vendorId)
            ->where('status', 'delivered');

        $totalRevenue = (clone $delivered)
            ->sum(\DB::raw('price * quantity'));

        $productsSold = (clone $delivered)
            ->sum('quantity');

        $completedOrders = (clone $delivered)
            ->distinct('order_id')
            ->count('order_id');

        $averageOrder = $completedOrders
            ? $totalRevenue / $completedOrders
            : 0;

        return [

            Stat::make('Total Revenue', 'Rs. ' . number_format($totalRevenue, 2))
                ->description('Delivered Orders')
                ->color('success'),

            Stat::make('Completed Orders', number_format($completedOrders))
                ->color('primary'),

            Stat::make('Products Sold', number_format($productsSold))
                ->color('warning'),

            Stat::make('Average Order', 'Rs. ' . number_format($averageOrder, 2))
                ->color('info'),

        ];
    }
}