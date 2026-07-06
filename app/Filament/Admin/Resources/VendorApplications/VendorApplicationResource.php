<?php

namespace App\Filament\Admin\Resources\VendorApplications;

use App\Filament\Admin\Resources\VendorApplications\Pages\CreateVendorApplication;
use App\Filament\Admin\Resources\VendorApplications\Pages\EditVendorApplication;
use App\Filament\Admin\Resources\VendorApplications\Pages\ListVendorApplications;
use App\Filament\Admin\Resources\VendorApplications\Schemas\VendorApplicationForm;
use App\Filament\Admin\Resources\VendorApplications\Tables\VendorApplicationsTable;
use App\Models\VendorApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VendorApplicationResource extends Resource
{
    protected static ?string $model = VendorApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VendorApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VendorApplicationsTable::configure($table);
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
            'index' => ListVendorApplications::route('/'),
            'create' => CreateVendorApplication::route('/create'),
            'edit' => EditVendorApplication::route('/{record}/edit'),
        ];
    }
}
