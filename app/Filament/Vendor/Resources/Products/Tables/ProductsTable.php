<?php

namespace App\Filament\Vendor\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Builder;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use PHPUnit\Util\Filter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->columns([
                ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->label('Thumbnail'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),

                TextColumn::make('price')
                    ->money('NPR')
                    ->sortable(),

                TextColumn::make('stock')
                    ->sortable(),

                TextColumn::make('images_count')
                    ->counts('images')
                    ->label('Images'),

                TextColumn::make('variants_count')
                    ->counts('variants')
                    ->label('Variants'),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'available',
                        'danger' => 'out_of_stock',
                    ]),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->since(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'available' => 'Available',
                        'out_of_stock' => 'Out of Stock',
                    ]),

                // Filter::make('low_stock')
                //     ->label('Low Stock')
                //     ->query(fn(Builder $query): Builder => $query->where('stock', '<=', 5)),

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Product'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
