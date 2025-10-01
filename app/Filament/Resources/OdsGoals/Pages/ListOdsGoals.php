<?php

namespace App\Filament\Resources\OdsGoals\Pages;

use App\Filament\Resources\OdsGoals\OdsGoalsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOdsGoals extends ListRecords
{
    protected static string $resource = OdsGoalsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nova Meta'),
        ];
    }
}

