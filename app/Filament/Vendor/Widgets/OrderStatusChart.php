<?php

namespace App\Filament\Vendor\Widgets;

use App\Models\OrderItem;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;

class OrderStatusChart extends ChartWidget
{
    protected ?string $heading = 'Order Status Distribution';

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $vendorId = Filament::auth()->id();

        $statuses = [
            'pending',
            'processing',
            'packed',
            'shipped',
            'delivered',
            'cancelled',
        ];

        $data = [];

        foreach ($statuses as $status) {
            $data[] = OrderItem::where('vendor_id', $vendorId)
                ->where('status', $status)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data,
                ],
            ],

            'labels' => [
                'Pending',
                'Processing',
                'Packed',
                'Shipped',
                'Delivered',
                'Cancelled',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
    protected function getOptions(): array
    {
        return [
            'cutout' => '60%',

            'plugins' => [

                'legend' => [

                    'position' => 'bottom',

                ],

            ],

        ];
    }
}
