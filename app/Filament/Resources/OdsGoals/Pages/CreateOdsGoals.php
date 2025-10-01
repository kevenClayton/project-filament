<?php

namespace App\Filament\Resources\OdsGoals\Pages;

use App\Filament\Resources\OdsGoals\OdsGoalsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOdsGoals extends CreateRecord
{
    protected static string $resource = OdsGoalsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

