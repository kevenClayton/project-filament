<?php

namespace App\Filament\Resources\BoasPraticas\Pages;

use App\Filament\Resources\BoasPraticas\BoasPraticasResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBoasPraticas extends EditRecord
{
    protected static string $resource = BoasPraticasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
