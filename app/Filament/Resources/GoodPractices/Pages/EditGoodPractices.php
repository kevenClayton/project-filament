<?php

namespace App\Filament\Resources\GoodPractices\Pages;

use App\Filament\Resources\GoodPractices\GoodPracticesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGoodPractices extends EditRecord
{
    protected static string $resource = GoodPracticesResource::class;

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

