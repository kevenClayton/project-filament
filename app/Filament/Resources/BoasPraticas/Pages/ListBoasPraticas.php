<?php

namespace App\Filament\Resources\BoasPraticas\Pages;

use App\Filament\Resources\BoasPraticas\BoasPraticasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListBoasPraticas extends ListRecords
{
    protected static string $resource = BoasPraticasResource::class;

    protected static ?string $title = 'Boas Práticas';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Boa Prática')
                ->icon('heroicon-o-plus'),
        ];
    }
}
