<?php

namespace App\Filament\Resources\OdsObjectives;

use App\Filament\Resources\OdsObjectives\Pages\CreateOdsObjectives;
use App\Filament\Resources\OdsObjectives\Pages\EditOdsObjectives;
use App\Filament\Resources\OdsObjectives\Pages\ListOdsObjectives;
use App\Filament\Resources\OdsObjectives\Pages\ViewOdsObjectives;
use App\Filament\Resources\OdsObjectives\Schemas\OdsObjectivesForm;
use App\Filament\Resources\OdsObjectives\Schemas\OdsObjectivesInfolist;
use App\Filament\Resources\OdsObjectives\Tables\OdsObjectivesTable;
use App\Models\OdsObjective;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class OdsObjectivesResource extends Resource
{
    protected static ?string $model = OdsObjective::class;

    protected static ?string $navigationLabel = 'Objetivos';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-flag';
    protected static string|UnitEnum|null $navigationGroup = 'Gestor';
    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Objetivo';
    protected static ?string $pluralModelLabel = 'Objetivos';

    protected static ?string $recordTitleAttribute = 'title';

    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public static function form(Schema $schema): Schema
    {
        return OdsObjectivesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OdsObjectivesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OdsObjectivesTable::configure($table);
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
            'index' => ListOdsObjectives::route('/'),
            'create' => CreateOdsObjectives::route('/create'),
            'view' => ViewOdsObjectives::route('/{record}'),
            'edit' => EditOdsObjectives::route('/{record}/edit'),
        ];
    }
}

