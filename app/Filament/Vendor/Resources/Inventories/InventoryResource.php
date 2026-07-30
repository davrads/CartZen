<?php

namespace App\Filament\Vendor\Resources\Inventories;

use App\Filament\Vendor\Resources\Inventories\Pages\EditInventory;
use App\Filament\Vendor\Resources\Inventories\Pages\ListInventories;
use App\Filament\Vendor\Resources\Inventories\Pages\ViewInventory;
use App\Filament\Vendor\Resources\Inventories\Schemas\InventoryForm;
use App\Filament\Vendor\Resources\Inventories\Tables\InventoriesTable;
use App\Models\Product;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class InventoryResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $navigationLabel = 'Inventory';
    protected static string|UnitEnum|null $navigationGroup = 'Store Management';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('vendor_id', Filament::auth()->user()->id);
    }

    public static function form(Schema $schema): Schema
    {
        return InventoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InventoriesTable::configure($table);
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
            'index' => ListInventories::route('/'),
            'view' => ViewInventory::route('/{record}'),
            'edit' => EditInventory::route('/{record}/edit'),
        ];
    }
    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
