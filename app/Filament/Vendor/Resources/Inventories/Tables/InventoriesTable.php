<?php

namespace App\Filament\Vendor\Resources\Inventories\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InventoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('')
                    ->square()
                    ->size(55)
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

                TextColumn::make('sku')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),

                TextColumn::make('stock')
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state == 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    })
                    ->icon(fn($state) => match (true) {
                        $state == 0 => 'heroicon-o-x-circle',
                        $state <= 10 => 'heroicon-o-exclamation-triangle',
                        default => 'heroicon-o-check-circle',
                    }),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'available' => 'success',
                        'out_of_stock' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->since(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'available' => 'Available',
                        'out_of_stock' => 'Out of Stock',
                    ])
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }
}
