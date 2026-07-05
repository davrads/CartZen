<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class VendorStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $vendorId = Auth::id();
        return [
            Stat::make(
                'Total Products',
                Product::where('vendor_id', $vendorId)->count()
            )
                ->description('Products in your catalog')
                ->descriptionIcon('heroicon-s-cube-transparent')
                ->color('primary'),

            Stat::make(
                'Available Products',
                Product::where('vendor_id', $vendorId)
                    ->where('status', 'available')
                    ->count()
            )

                ->description('Currently available')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make(
                'Featured Products',
                Product::where('vendor_id', $vendorId)
                    ->where('featured', true)
                    ->count()
            )
                ->description('Featured on storefront')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make(
                'Low Stock',
                Product::where('vendor_id', $vendorId)
                    ->where('stock', '<=', 5)
                    ->count()
            )
                ->description('Needs restocking')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
