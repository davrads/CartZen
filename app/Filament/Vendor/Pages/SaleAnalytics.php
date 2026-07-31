<?php

namespace App\Filament\Vendor\Pages;

use App\Filament\Vendor\Widgets\InventoryAlerts;
use App\Filament\Vendor\Widgets\MonthlyRevenueChart;
use App\Filament\Vendor\Widgets\OrderStatusChart;
use App\Filament\Vendor\Widgets\RecentSales;
use App\Filament\Vendor\Widgets\RevenueOverview;
use App\Filament\Vendor\Widgets\TopSellingProducts;
use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class SalesAnalytics extends Page
{
        protected static bool $shouldRegisterNavigation = true;

    protected static  string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static ?string $navigationLabel = 'Sales Analytics';

   protected static string|UnitEnum|null $navigationGroup= 'Analytics';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.vendor.pages.sale-analytics';

    protected function getHeaderWidgets(): array
    {
        return [
            RevenueOverview::class,
            MonthlyRevenueChart::class,
            OrderStatusChart::class,
            TopSellingProducts::class,
            InventoryAlerts::class,
            RecentSales::class,
        ];
    }

    public static function canAccess(): bool
{
    return true;
}
}