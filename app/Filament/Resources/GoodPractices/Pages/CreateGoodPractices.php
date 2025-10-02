<?php

namespace App\Filament\Resources\GoodPractices\Pages;

use App\Filament\Resources\GoodPractices\GoodPracticesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGoodPractices extends CreateRecord
{
    protected static string $resource = GoodPracticesResource::class;
    public string $view = 'filament.pages.good-practices-wizard';


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

