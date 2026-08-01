<?php

namespace App\Filament\Admin\Resources\Products\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

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

                TextColumn::make('verification_status')
                    ->label('Verification')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->color(fn(string $state) => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('rejection_reason')
                    ->limit(40)
                    ->tooltip(fn($record) => $record->rejection_reason)
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                IconColumn::make('flash_sale')
                    ->label('Flash Deal')
                    ->state(fn($record) => $record->flashSale()->exists())
                    ->boolean()
                    ->trueIcon('heroicon-o-bolt')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('flashSale.end_date')
                    ->label('Flash Ends')
                    ->dateTime('d M Y, h:i A')
                    ->placeholder('-')
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

                TernaryFilter::make('flash_sale')
                    ->label('Flash Deal')
                    ->queries(
                        true: fn($query) => $query->whereHas('flashSale'),
                        false: fn($query) => $query->whereDoesntHave('flashSale'),
                        blank: fn($query) => $query,
                    ),

                SelectFilter::make('verification_status')
                    ->options([
                        'approved' => 'Approved',
                        'pending' => 'Pending',
                        'rejected' => 'Rejected',
                    ]),

            ])

            ->recordActions([
                EditAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')

                    ->visible(fn($record) => $record->verification_status !== 'approved')
                    ->successNotificationTitle('Product approved successfully')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'verification_status' => 'approved',
                            'verified_by' => Auth::id(),
                            'verified_at' => now(),
                            'rejection_reason' => null,
                        ]);
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->visible(
                        fn($record) =>
                        $record->verification_status !== 'rejected'
                    )
                    ->successNotificationTitle('Product rejected successfully')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('reason')
                            ->label('Rejection Reason')
                            ->required()
                            ->rows(5),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'verification_status' => 'rejected',
                            'verified_by' => Auth::id(),
                            'verified_at' => now(),
                            'rejection_reason' => $data['reason'],
                        ]);
                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
