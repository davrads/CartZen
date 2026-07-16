<?php

namespace App\Filament\Vendor\Resources\CustomerOrders\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CustomerOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('customer_number')
                    ->label('Order No.')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('NPR')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'primary' => 'shipped',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ]),

                TextColumn::make('created_at')
                    ->label('Ordered On')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),

            ])

            ->actions([
                ViewAction::make(),
            ])

            ->bulkActions([]);
    }
}