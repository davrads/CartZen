<?php

namespace App\Filament\Vendor\Resources\ProductReviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('rating')
                ->formatStateUsing(fn ($state) => "{$state} ★")
                    ->badge()
                    ->color(fn ($state) => match (true){
                        $state >= 4 => 'success',
                        $state == 3 => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state))
                    ->sortable(),

                TextColumn::make('comment')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Reviewed On')
                    ->dateTime('M d, Y')
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('rating')
                    ->options([
                        5 => '★★★★★',
                        4 => '★★★★☆',
                        3 => '★★★☆☆',
                        2 => '★★☆☆☆',
                        1 => '★☆☆☆☆',
                    ]),

            ])

            ->actions([
                ViewAction::make(),

            ])

            ->bulkActions([
            ]);
    
    }
}
