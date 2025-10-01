<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?int $navigationSort = 1;

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
