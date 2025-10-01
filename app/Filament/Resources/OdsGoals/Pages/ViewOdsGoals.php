<?php

namespace App\Filament\Resources\OdsGoals\Pages;

use App\Filament\Resources\OdsGoals\OdsGoalsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOdsGoals extends ViewRecord
{
    protected static string $resource = OdsGoalsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

