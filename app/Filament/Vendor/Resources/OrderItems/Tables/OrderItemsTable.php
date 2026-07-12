<?php

namespace App\Filament\Vendor\Resources\OrderItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->defaultSort('created_at','desc')

            ->columns([

    ImageColumn::make('product.thumbnail')
        ->disk('public')
        ->label(''),

    TextColumn::make('order.order_number')
        ->label('Order')
        ->searchable()
        ->copyable(),

    TextColumn::make('product.name')
        ->searchable()
        ->sortable()
        ->limit(30),

    TextColumn::make('order.customer.name')
        ->label('Customer')
        ->searchable(),

    TextColumn::make('quantity')
        ->alignCenter(),

    TextColumn::make('price')
        ->money('NPR'),

    TextColumn::make('shipping_cost')
        ->money('NPR'),

    TextColumn::make('order.status')
        ->badge()
        ->sortable(),

    TextColumn::make('created_at')
        ->since(),

])

            ->filters([

                SelectFilter::make('order.status')
                    ->relationship('order','status')

            ])

            ->recordActions([

                EditAction::make()
                ->label('Update Status'),
                ViewAction::make(),

            ])

            ->toolbarActions([

               // BulkActionGroup::make([

                  //  DeleteBulkAction::make(),

                ]);

        
    }
}