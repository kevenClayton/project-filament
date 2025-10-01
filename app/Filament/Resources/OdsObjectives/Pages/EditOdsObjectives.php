<?php

namespace App\Filament\Resources\OdsObjectives\Pages;

use App\Filament\Resources\OdsObjectives\OdsObjectivesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOdsObjectives extends EditRecord
{
    protected static string $resource = OdsObjectivesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

