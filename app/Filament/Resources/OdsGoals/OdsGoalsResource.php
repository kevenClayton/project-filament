<?php

namespace App\Filament\Resources\OdsGoals;

use App\Filament\Resources\OdsGoals\Pages\CreateOdsGoals;
use App\Filament\Resources\OdsGoals\Pages\EditOdsGoals;
use App\Filament\Resources\OdsGoals\Pages\ListOdsGoals;
use App\Filament\Resources\OdsGoals\Pages\ViewOdsGoals;
use App\Filament\Resources\OdsGoals\Schemas\OdsGoalsForm;
use App\Filament\Resources\OdsGoals\Schemas\OdsGoalsInfolist;
use App\Filament\Resources\OdsGoals\Tables\OdsGoalsTable;
use App\Models\OdsGoal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class OdsGoalsResource extends Resource
{
    protected static ?string $model = OdsGoal::class;

    protected static ?string $navigationLabel = 'Metas';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-check-circle';
    protected static string|UnitEnum|null $navigationGroup = 'Gestor';
    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Meta';
    protected static ?string $pluralModelLabel = 'Metas';

    protected static ?string $recordTitleAttribute = 'title';

    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public static function form(Schema $schema): Schema
    {
        return OdsGoalsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OdsGoalsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OdsGoalsTable::configure($table);
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
            'index' => ListOdsGoals::route('/'),
            'create' => CreateOdsGoals::route('/create'),
            'view' => ViewOdsGoals::route('/{record}'),
            'edit' => EditOdsGoals::route('/{record}/edit'),
        ];
    }
}

