<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderStatusChart extends ChartWidget
{
    protected ?string $heading = 'Orders by Status';
        protected int|string|array $columnSpan = 'full';


    protected function getData(): array
    {
        return [
            'labels' => [
                'Pending',
                'Processing',
                'Shipped',
                'Delivered',
                'Cancelled',
            ],

            'datasets' => [
                [
                    'data' => [
                        Order::where('status','pending')->count(),
                        Order::where('status','processing')->count(),
                        Order::where('status','shipped')->count(),
                        Order::where('status','delivered')->count(),
                        Order::where('status','cancelled')->count(),
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}