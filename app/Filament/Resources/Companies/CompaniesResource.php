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
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class CompaniesResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|UnitEnum|null $navigationGroup = 'Gestor';

    protected static ?string $navigationLabel = 'Empresas';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Check if the user can view any records
     */
    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

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
