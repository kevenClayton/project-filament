<?php

namespace App\Filament\Resources\OdsObjectives\Pages;

use App\Filament\Resources\OdsObjectives\OdsObjectivesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOdsObjectives extends ListRecords
{
    protected static string $resource = OdsObjectivesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Novo Objetivo'),
        ];
    }
}

