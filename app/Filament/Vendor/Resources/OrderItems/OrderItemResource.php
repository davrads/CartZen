<?php

namespace App\Filament\Vendor\Resources\OrderItems;

use App\Filament\Vendor\Resources\OrderItems\Pages\CreateOrderItem;
use App\Filament\Vendor\Resources\OrderItems\Pages\EditOrderItem;
use App\Filament\Vendor\Resources\OrderItems\Pages\ListOrderItems;
use App\Filament\Vendor\Resources\OrderItems\Pages\ViewOrderItem;
use App\Filament\Vendor\Resources\OrderItems\Schemas\OrderItemForm;
use App\Filament\Vendor\Resources\OrderItems\Tables\OrderItemsTable;
use App\Models\OrderItem;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Override;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;
    protected static ?string $navigationLabel = 'Orders';

    protected static string|UnitEnum|null $navigationGroup = 'Store Management';

    protected static ?int $navigationSort = 2;
    #[Override]
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('vendor_id', Auth::id());
    }
    public static function form(Schema $schema): Schema
    {
        return OrderItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderItemsTable::configure($table);
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
            'index' => ListOrderItems::route('/'),
          //  'create' => CreateOrderItem::route('/create'),
            'edit' => EditOrderItem::route('/{record}/edit'),
            'view' => ViewOrderItem::route('/{record}'),
        ];
    }

    public static function canCreate():bool
    {
        return false;
    }
}
