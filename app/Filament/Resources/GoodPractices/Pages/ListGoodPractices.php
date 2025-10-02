<?php

namespace App\Filament\Resources\GoodPractices\Pages;

use App\Filament\Resources\GoodPractices\GoodPracticesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGoodPractices extends ListRecords
{
    protected static string $resource = GoodPracticesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nova Boa Prática'),
        ];
    }
}

