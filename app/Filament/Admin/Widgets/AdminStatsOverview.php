<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\VendorProfile;
use App\Models\FlashSale;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $revenue = Order::where('status', 'delivered')
            ->sum('total_amount');

        return [

            Stat::make(
                'Total Revenue',
                'NPR ' . number_format($revenue, 2)
            )
                ->description('Completed Orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make(
                'Total Orders',
                Order::count()
            )
                ->description('All Orders')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make(
                'Products',
                Product::count()
            )
                ->description('Marketplace Products')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),

            Stat::make(
                'Customers',
                User::where('role', 'customer')->count()
            )
                ->description('Registered Customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),

            Stat::make(
                'Approved Vendors',
                VendorProfile::where('status', 'approved')->count()
            )
                ->description('Active Vendors')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('success'),

            Stat::make(
                'Pending Products',
                Product::where('verification_status', 'pending')->count()
            )
                ->description('Need Verification')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),

        ];
    }
}