<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class PendingProducts extends TableWidget
{
    protected static ?string $heading = 'Pending Product Verification';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('verification_status', 'pending')
                    ->latest()
                    ->limit(3)
            )

            ->columns([

                ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('vendor.name'),

                TextColumn::make('category.name'),

                TextColumn::make('created_at')
                    ->since(),
            ]);
    }
}