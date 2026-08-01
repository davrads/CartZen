<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class MonthlyRevenueChart extends ChartWidget
{
    protected  ?string $heading = 'Monthly Revenue';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $labels = [];
        $revenue = [];

        foreach (range(5, 0) as $month) {

            $date = now()->subMonths($month);

            $labels[] = $date->format('M');

            $revenue[] = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', 'delivered')
                ->sum('total_amount');
        }

        $labels[] = now()->format('M');

        $revenue[] = Order::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->where('status', 'delivered')
            ->sum('total_amount');

        return [

            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $revenue,
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