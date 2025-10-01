<?php

namespace App\Filament\Resources\OdsObjectives\Pages;

use App\Filament\Resources\OdsObjectives\OdsObjectivesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOdsObjectives extends CreateRecord
{
    protected static string $resource = OdsObjectivesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

