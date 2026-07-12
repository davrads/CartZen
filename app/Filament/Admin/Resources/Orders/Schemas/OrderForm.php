<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Customer Information')
                    ->schema([

                        Placeholder::make('customer')
                            ->label('Customer')
                            ->content(fn ($record) => $record?->customer?->name ?? '-'),

                        Placeholder::make('email')
                            ->label('Email')
                            ->content(fn ($record) => $record?->customer?->email ?? '-'),

                    ])
                    ->columns(2),

                Section::make('Shipping Address')
                    ->schema([

                        Placeholder::make('address.full_name')
                            ->label('Receiver')
                            ->content(fn ($record) => $record?->address?->full_name ?? '-'),

                        Placeholder::make('address.phone')
                            ->label('Phone')
                            ->content(fn ($record) => $record?->address?->phone ?? '-'),

                        Placeholder::make('address.province')
                            ->label('Province')
                            ->content(fn ($record) => $record?->address?->province ?? '-'),

                        Placeholder::make('address.district')
                            ->label('District')
                            ->content(fn ($record) => $record?->address?->district ?? '-'),

                        Placeholder::make('address.city')
                            ->label('City')
                            ->content(fn ($record) => $record?->address?->city ?? '-'),

                        Placeholder::make('address.address_line')
                            ->label('Address')
                            ->content(fn ($record) => $record?->address?->address ?? '-'),

                        Placeholder::make('address.postal_code')
                            ->label('Postal Code')
                            ->content(fn ($record) => $record?->address?->postal_code ?? '-'),
                    ])
                    ->columns(2),

                Section::make('Order Information')
                    ->schema([

                        Placeholder::make('order_number')
                            ->label('Order Number')
                            ->content(fn ($record) => $record?->order_number),

                        Placeholder::make('created_at')
                            ->label('Ordered At')
                            ->content(fn ($record) => $record?->created_at?->format('d M Y h:i A')),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),

                    ])
                    ->columns(3),

                Section::make('Order Summary')
                    ->schema([

                        Placeholder::make('sub_total')
                            ->label('Subtotal')
                            ->content(fn ($record) => 'Rs. ' . number_format($record->sub_total, 2)),

                        Placeholder::make('shipping_charge')
                            ->label('Shipping')
                            ->content(fn ($record) => 'Rs. ' . number_format($record->shipping_charge, 2)),

                        Placeholder::make('tax')
                            ->label('Tax')
                            ->content(fn ($record) => 'Rs. ' . number_format($record->tax, 2)),

                        Placeholder::make('discount')
                            ->label('Discount')
                            ->content(fn ($record) => 'Rs. ' . number_format($record->discount, 2)),

                        Placeholder::make('total_amount')
                            ->label('Grand Total')
                            ->content(fn ($record) => 'Rs. ' . number_format($record->total_amount, 2)),

                    ])
                    ->columns(5),

            ]);
    }
}