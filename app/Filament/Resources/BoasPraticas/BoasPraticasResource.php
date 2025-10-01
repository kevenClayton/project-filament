<?php

namespace App\Filament\Resources\BoasPraticas;

use BackedEnum;
use App\Filament\Resources\BoasPraticas\Pages\CreateBoasPraticas;
use App\Filament\Resources\BoasPraticas\Pages\EditBoasPraticas;
use App\Filament\Resources\BoasPraticas\Pages\ListBoasPraticas;
use App\Filament\Resources\BoasPraticas\Pages\ViewBoasPraticas;
use App\Filament\Resources\BoasPraticas\Schemas\BoasPraticasForm;
use App\Filament\Resources\BoasPraticas\Schemas\BoasPraticasInfolist;
use App\Filament\Resources\BoasPraticas\Tables\BoasPraticasTable;
use App\Models\BoasPraticas;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BoasPraticasResource extends Resource
{
    protected static ?string $model = BoasPraticas::class;

    protected static ?string $navigationLabel = 'Boas Práticas';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Boa Prática';

    protected static ?string $pluralModelLabel = 'Boas Práticas';

    protected static ?string $recordTitleAttribute = 'titulo';

    public static function form(Schema $schema): Schema
    {
        return BoasPraticasForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BoasPraticasInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BoasPraticasTable::configure($table);
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
            'index' => ListBoasPraticas::route('/'),
            'create' => CreateBoasPraticas::route('/create'),
            'view' => ViewBoasPraticas::route('/{record}'),
            'edit' => EditBoasPraticas::route('/{record}/edit'),
        ];
    }
}
