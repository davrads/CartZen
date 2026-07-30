<?php

namespace App\Filament\Admin\Resources\Reviews\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('rating')
                ->formatStateUsing(fn ($state) => "{$state} ★")
                    ->badge()
                    ->color(fn ($state) => match (true){
                        $state >= 4 => 'success',
                        $state == 3 => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('comment')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reviewed On')
                    ->dateTime('M d, Y')
                    ->sortable(),

            ])

            ->filters([

                Tables\Filters\SelectFilter::make('rating')
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

                DeleteAction::make(),
            ])

            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}