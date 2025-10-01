<?php

namespace App\Filament\Resources\Companies;

use App\Filament\Resources\Companies\Pages\CreateCompanies;
use App\Filament\Resources\Companies\Pages\EditCompanies;
use App\Filament\Resources\Companies\Pages\ListCompanies;
use App\Filament\Resources\Companies\Pages\ViewCompanies;
use App\Filament\Resources\Companies\Schemas\CompaniesForm;
use App\Filament\Resources\Companies\Schemas\CompaniesInfolist;
use App\Filament\Resources\Companies\Tables\CompaniesTable;
use App\Models\Company;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompaniesResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CompaniesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompaniesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
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
            'index' => ListCompanies::route('/'),
            'create' => CreateCompanies::route('/create'),
            'view' => ViewCompanies::route('/{record}'),
            'edit' => EditCompanies::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
