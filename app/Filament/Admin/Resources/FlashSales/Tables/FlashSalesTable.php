<?php

namespace App\Filament\Admin\Resources\FlashSales\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FlashSalesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('product.thumbnail')
                    ->label('Image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('product.vendor.name')
                    ->label('Vendor')
                    ->searchable(),

                TextColumn::make('product.price')
                    ->label('Original Price')
                    ->money('NPR')
                    ->sortable(),

                TextColumn::make('flash_price')
                    ->label('Flash Price')
                    ->money('NPR')
                    ->sortable(),

                TextColumn::make('discount_percent')
                    ->label('Discount')
                    ->suffix('%'),

                TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}