<?php

namespace App\Filament\Admin\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('thumbnail')
                    ->label('Image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('vendor.name')
                    ->label('Vendor')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable(),

                TextColumn::make('price')
                    ->money('NPR')
                    ->sortable(),

                TextColumn::make('stock')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge(),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                IconColumn::make('is_flash_deal')
                    ->label('Flash Deal')
                    ->boolean()
                    ->trueIcon('heroicon-o-bolt')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('flash_deal_ends_at')
                    ->label('Flash Ends')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('images_count')
                    ->counts('images')
                    ->label('Gallery'),

                TextColumn::make('variants_count')
                    ->counts('variants')
                    ->label('Variants'),
            ])

            ->filters([

                TernaryFilter::make('featured')
                    ->label('Featured'),

                TernaryFilter::make('is_flash_deal')
                    ->label('Flash Deal'),

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