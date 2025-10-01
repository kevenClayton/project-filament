<?php

namespace App\Filament\Resources\BoasPraticas\Pages;

use App\Filament\Resources\BoasPraticas\BoasPraticasResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBoasPraticas extends ViewRecord
{
    protected static string $resource = BoasPraticasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
