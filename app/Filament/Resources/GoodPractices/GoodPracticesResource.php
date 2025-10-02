<?php

namespace App\Filament\Resources\GoodPractices;

use App\Filament\Resources\GoodPractices\Pages\CreateGoodPractices;
use App\Filament\Resources\GoodPractices\Pages\EditGoodPractices;
use App\Filament\Resources\GoodPractices\Pages\ListGoodPractices;
use App\Filament\Resources\GoodPractices\Pages\ViewGoodPractices;
use App\Filament\Resources\GoodPractices\Schemas\GoodPracticesForm;
use App\Filament\Resources\GoodPractices\Schemas\GoodPracticesInfolist;
use App\Filament\Resources\GoodPractices\Tables\GoodPracticesTable;
use App\Models\GoodPractice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class GoodPracticesResource extends Resource
{
    protected static ?string $model = GoodPractice::class;

    protected static ?string $navigationLabel = 'Boas Práticas';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Boa Prática';

    protected static ?string $pluralModelLabel = 'Boas Práticas';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return GoodPracticesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GoodPracticesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GoodPracticesTable::configure($table);
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
            'index' => ListGoodPractices::route('/'),
            'create' => CreateGoodPractices::route('/create'),
            'view' => ViewGoodPractices::route('/{record}'),
            'edit' => EditGoodPractices::route('/{record}/edit'),
        ];
    }
}

