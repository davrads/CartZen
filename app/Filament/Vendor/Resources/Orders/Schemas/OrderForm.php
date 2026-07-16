<?php

namespace App\Filament\Vendor\Resources\CustomerOrders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Order Information')
                    ->columns(3)
                    ->schema([

                        TextInput::make('order_number')
                            ->disabled(),

                        TextInput::make('status')
                            ->disabled(),

                        TextInput::make('total_amount')
                            ->prefix('NPR')
                            ->disabled(),

                    ]),

                Section::make('Customer Details')
                    ->columns(2)
                    ->schema([

                        TextInput::make('customer.name')
                            ->label('Customer Name')
                            ->disabled(),

                        TextInput::make('customer.email')
                            ->disabled(),

                    ]),

                Section::make('Shipping Address')
                    ->columns(2)
                    ->schema([

                        TextInput::make('address.full_name')
                            ->disabled(),

                        TextInput::make('address.phone')
                            ->disabled(),

                        TextInput::make('address.province')
                            ->disabled(),

                        TextInput::make('address.district')
                            ->disabled(),

                        TextInput::make('address.city')
                            ->disabled(),

                        TextInput::make('address.postal_code')
                            ->disabled(),

                        TextInput::make('address.address_line')
                            ->columnSpanFull()
                            ->disabled(),

                    ]),

            ]);
    }
}