<?php

namespace App\Filament\Resources\OdsObjectives\Pages;

use App\Filament\Resources\OdsObjectives\OdsObjectivesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOdsObjectives extends ViewRecord
{
    protected static string $resource = OdsObjectivesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

