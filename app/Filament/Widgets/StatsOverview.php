<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\GoodPractice;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalCompanies = Company::count();
        $totalGoodPractices = GoodPractice::count();

        // Calcular maturidade ESG média (baseado no campo sustainability_maturity)
        $avgMaturity = Company::whereNotNull('sustainability_maturity')
            ->avg('sustainability_maturity');
        $avgMaturity = $avgMaturity ? round($avgMaturity, 1) : 0;

        return [
            Stat::make('Empresas Registadas', number_format($totalCompanies, 0, ',', '.'))
                ->description('Total de empresas na plataforma')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Boas Práticas', number_format($totalGoodPractices, 0, ',', '.'))
                ->description('Total de boas práticas registadas')
                ->descriptionIcon('heroicon-m-light-bulb')
                ->color('success')
                ->chart([3, 2, 5, 3, 6, 5, 4, 3]),

            Stat::make('Maturidade ESG Média', $avgMaturity > 0 ? "{$avgMaturity} / 5" : 'N/A')
                ->description('Baseado nas empresas avaliadas')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($avgMaturity >= 3.5 ? 'success' : ($avgMaturity >= 2.5 ? 'warning' : 'danger'))
                ->chart([2, 3, 3, 4, 5, 4, 3, 4]),
        ];
    }
}
