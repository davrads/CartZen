<?php

namespace App\Filament\Admin\Resources\FlashSales;

use App\Filament\Admin\Resources\FlashSales\Pages\CreateFlashSale;
use App\Filament\Admin\Resources\FlashSales\Pages\EditFlashSale;
use App\Filament\Admin\Resources\FlashSales\Pages\ListFlashSales;
use App\Filament\Admin\Resources\FlashSales\Schemas\FlashSaleForm;
use App\Filament\Admin\Resources\FlashSales\Tables\FlashSalesTable;
use App\Models\FlashSale;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FlashSaleResource extends Resource
{
    protected static ?string $model = FlashSale::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;
    protected static ?string $navigationLabel = 'Flash Sales';

    protected static string|UnitEnum|null $navigationGroup = 'Catalog Management';

    protected static ?int $navigationSort = 3;
    public static function form(Schema $schema): Schema
    {
        return FlashSaleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FlashSalesTable::configure($table);
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
            'index' => ListFlashSales::route('/'),
            'create' => CreateFlashSale::route('/create'),
            'edit' => EditFlashSale::route('/{record}/edit'),
        ];
    }
}
