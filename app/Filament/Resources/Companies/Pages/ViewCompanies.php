<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompaniesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanies extends ViewRecord
{
    protected static string $resource = CompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
