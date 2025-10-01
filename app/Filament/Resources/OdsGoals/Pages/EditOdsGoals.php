<?php

namespace App\Filament\Resources\OdsGoals\Pages;

use App\Filament\Resources\OdsGoals\OdsGoalsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOdsGoals extends EditRecord
{
    protected static string $resource = OdsGoalsResource::class;

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

