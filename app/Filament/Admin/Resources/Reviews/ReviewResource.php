<?php

namespace App\Filament\Admin\Resources\Reviews;

use App\Filament\Admin\Resources\Reviews\Pages\CreateReview;
use App\Filament\Admin\Resources\Reviews\Pages\EditReview;
use App\Filament\Admin\Resources\Reviews\Pages\ListReviews;
use App\Filament\Admin\Resources\Reviews\Pages\ViewReview;
use App\Filament\Admin\Resources\Reviews\Schemas\ReviewForm;
use App\Filament\Admin\Resources\Reviews\Tables\ReviewsTable;
use App\Models\Review;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static ?string $navigationLabel = 'Reviews';

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReviewsTable::configure($table);
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
            'index' => ListReviews::route('/'),
            'view' => ViewReview::route('/{record}'),
        ];
    }
    public static function canCreate(): bool
    {
        return false;
    }
}
