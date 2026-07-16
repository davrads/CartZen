<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VendorOrderStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $vendorId = Filament::auth()->id();

        return [

            Stat::make(
                'Total Orders',
                OrderItem::where('vendor_id', $vendorId)->count()
            )
                ->description('Orders received')
                ->icon('heroicon-o-shopping-bag')
                ->color('primary'),

            Stat::make(
                'Pending',
                OrderItem::where('vendor_id', $vendorId)
                    ->where('status', 'pending')
                    ->count()
            )
                ->description('Awaiting action')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make(
                'Processing',
                OrderItem::where('vendor_id', $vendorId)
                    ->where('status', 'processing')
                    ->count()
            )
                ->description('Being prepared')
                ->icon('heroicon-o-arrow-path')
                ->color('info'),

            Stat::make(
                'Delivered',
                OrderItem::where('vendor_id', $vendorId)
                    ->where('status', 'delivered')
                    ->count()
            )
                ->description('Completed orders')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

        ];
    }
}