<?php

namespace App\Filament\Vendor\Resources\VendorProfiles;

use App\Filament\Vendor\Resources\VendorProfiles\Pages\CreateVendorProfile;
use App\Filament\Vendor\Resources\VendorProfiles\Pages\EditVendorProfile;
use App\Filament\Vendor\Resources\VendorProfiles\Pages\ListVendorProfiles;
use App\Filament\Vendor\Resources\VendorProfiles\Pages\ViewVendorProfile;
use App\Filament\Vendor\Resources\VendorProfiles\Schemas\VendorProfileForm;
use App\Filament\Vendor\Resources\VendorProfiles\Tables\VendorProfilesTable;
use App\Models\VendorProfile;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class VendorProfileResource extends Resource
{
    protected static ?string $model = VendorProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;
    protected static ?string $navigationLabel = 'Store Profile';
    protected static string|UnitEnum|null $navigationGroup = 'Store Management';
    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Filament::auth()->id());
    }
    public static function form(Schema $schema): Schema
    {
        return VendorProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VendorProfilesTable::configure($table);
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
            'index' => ListVendorProfiles::route('/'),
            'view' => ViewVendorProfile::route('/{record}'),
            'edit' => EditVendorProfile::route('/{record}/edit'),
        ];
    }

    public static function canCreate():bool
    {
        return false;
    }

    public static function canDelete($record):bool
    {
        return false;
    }
}
