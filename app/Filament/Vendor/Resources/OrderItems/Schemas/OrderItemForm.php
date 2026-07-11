<?php

namespace App\Filament\Vendor\Resources\OrderItems\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Product Information')
                    ->schema([

                        Placeholder::make('product')
                            ->label('Product')
                            ->content(fn ($record) => $record?->product?->name),

                        Placeholder::make('customer')
                            ->label('Customer')
                            ->content(fn ($record) => $record?->order?->user?->name),

                        Placeholder::make('quantity')
                            ->content(fn ($record) => $record?->quantity),

                        Placeholder::make('price')
                            ->content(fn ($record) => 'Rs. '.$record?->price),

                        Placeholder::make('shipping_cost')
                            ->content(fn ($record) => 'Rs. '.$record?->shipping_cost),

                    ])
                    ->columns(2),

                Section::make('Update Status')
                    ->schema([

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'packed' => 'Packed',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),

                    ])

            ]);
    }
}