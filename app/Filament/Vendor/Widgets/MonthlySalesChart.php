<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MonthlySalesChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Sales';
    protected int|string|array $columnSpan = 'full';
    protected function getData(): array
    {
        $vendorId = Filament::auth()->id();

        $sales = OrderItem::query()
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('order_items.vendor_id', $vendorId)
            ->where('order_items.status', 'delivered')
            ->whereYear('orders.created_at', now()->year)

            ->selectRaw('MONTH(orders.created_at) as month')
            ->selectRaw('SUM(order_items.price * order_items.quantity) as revenue')

            ->groupByRaw('MONTH(orders.created_at)')
            ->orderByRaw('MONTH(orders.created_at)')
            ->pluck('revenue', 'month');
        $labels = [];
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = Carbon::create()->month($month)->format('M');
            $data[] = (float) ($sales[$month] ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (NPR)',
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
