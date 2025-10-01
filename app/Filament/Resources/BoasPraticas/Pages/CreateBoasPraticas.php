<?php

namespace App\Filament\Resources\BoasPraticas\Pages;

use App\Filament\Resources\BoasPraticas\BoasPraticasResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBoasPraticas extends CreateRecord
{
    protected static string $resource = BoasPraticasResource::class;

    protected static ?string $title = 'Criar Boa Prática';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Associate the good practice with the user's company
        $data['empresa_id'] = auth()->user()->company_id;
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return '✅ Boa prática criada com sucesso!';
    }
}