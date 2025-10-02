<?php

namespace App\Filament\Resources\GoodPractices\Pages;

use App\Filament\Resources\GoodPractices\GoodPracticesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGoodPractices extends ViewRecord
{
    protected static string $resource = GoodPracticesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

