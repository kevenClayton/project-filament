<?php

namespace App\Filament\Resources\Companies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logotipo')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-company.png'))
                    ->size(50),

                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nif')
                    ->label('NIF')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->copyable(),

                TextColumn::make('sector_activity')
                    ->label('Setor')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('good_practices_count')
                    ->label('Boas Práticas')
                    ->counts('goodPractices')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                IconColumn::make('wizard_completed')
                    ->label('Onboarding')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Ativa')
                    ->sortable()
                    ->onColor('success')
                    ->offColor('danger'),

                TextColumn::make('created_at')
                    ->label('Criada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Ativas',
                        0 => 'Inativas',
                    ])
                    ->placeholder('Todas'),

                SelectFilter::make('wizard_completed')
                    ->label('Onboarding')
                    ->options([
                        1 => 'Completo',
                        0 => 'Pendente',
                    ])
                    ->placeholder('Todos'),

                SelectFilter::make('sector_activity')
                    ->label('Setor')
                    ->multiple()
                    ->searchable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s');
    }
}
