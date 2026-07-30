<?php

namespace App\Filament\Vendor\Resources\ProductReviews;

use App\Filament\Vendor\Resources\ProductReviews\Pages\ListProductReviews;
use App\Filament\Vendor\Resources\ProductReviews\Pages\ViewProductReview;
use App\Filament\Vendor\Resources\ProductReviews\Schemas\ProductReviewForm;
use App\Filament\Vendor\Resources\ProductReviews\Tables\ProductReviewsTable;
use App\Models\Review;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Override;
use UnitEnum;

class ProductReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static ?string $navigationLabel = 'Product Reviews';
    protected static string|UnitEnum|null $navigationGroup = 'Sales';
    protected static ?int $navigationSort = 3;

#[Override]
	public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
        ->whereHas('product' ,function ($query) {
            $query->where('vendor_id', Filament::auth()->id());
        });
    }
    public static function form(Schema $schema): Schema
    {
        return ProductReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductReviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductReviews::route('/'),
            'view'=> ViewProductReview::route('/{record}'),
            
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
