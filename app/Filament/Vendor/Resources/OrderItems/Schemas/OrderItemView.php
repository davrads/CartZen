<?php

namespace App\Filament\Vendor\Resources\OrderItems\Schemas;

use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Schemas\Components\Section as ComponentsSection;

class OrderItemInfolist
{
    public static function configure(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                Section::make('Customer Information')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('order.customer.name')
                                    ->label('Customer'),

                                TextEntry::make('order.customer.email')
                                    ->label('Email'),

                                TextEntry::make('order.address.phone')
                                    ->label('Phone'),

                                TextEntry::make('order.order_number')
                                    ->label('Order Number'),

                            ]),

                        TextEntry::make('order.address.address_line')
                            ->label('Delivery Address'),

                    ]),

                Section::make('Product Information')
                    ->schema([

                        ImageEntry::make('product.thumbnail')
                            ->disk('public')
                            ->height(120),

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('product.name'),

                                TextEntry::make('product.sku'),

                                TextEntry::make('product.brand'),

                                TextEntry::make('quantity'),

                                TextEntry::make('price')
                                    ->money('NPR'),

                                TextEntry::make('shipping_cost')
                                    ->money('NPR'),

                            ]),

                    ]),

                Section::make('Order Status')
                    ->schema([

                        TextEntry::make('order.status')
                            ->badge(),

                        TextEntry::make('created_at')
                            ->dateTime(),

                    ]),

            ]);
    }
}