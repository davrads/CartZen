<?php

namespace App\Filament\Admin\Resources\VendorProfiles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VendorProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('shop_logo'),

                TextColumn::make('shop_name'),

                TextColumn::make('phone'),

                TextColumn::make('status')
                    ->badge(),

            ])

            ->recordActions([

                EditAction::make(),

            ]);
    }
}