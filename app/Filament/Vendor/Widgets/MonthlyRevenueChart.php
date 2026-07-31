<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;

class MonthlyRevenueChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue';

    protected int|string|array $columnSpan = 2;

    protected function getData(): array
    {
        $vendorId = Filament::auth()->id();

        $sales = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('order_items.vendor_id', $vendorId)
            ->where('order_items.status', 'delivered')
            ->whereYear('orders.created_at', now()->year)
            ->selectRaw('MONTH(orders.created_at) as month')
            ->selectRaw('SUM(price * quantity) as revenue')
            ->groupByRaw('MONTH(orders.created_at)')
            ->pluck('revenue', 'month');

        $data = [];
        $labels = [];

        foreach (range(1, 12) as $month) {

            $labels[] = now()->month($month)->format('M');

            $data[] = $sales[$month] ?? 0;
        }

        return [

            'datasets' => [

                [

                    'label' => 'Revenue',

                    'data' => $data,

                ],

            ],

            'labels' => $labels,

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}