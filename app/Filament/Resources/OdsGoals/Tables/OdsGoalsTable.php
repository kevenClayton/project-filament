<?php

namespace App\Filament\Resources\OdsGoals\Tables;

use App\Models\OdsObjective;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OdsGoalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('Ordem')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                ImageColumn::make('image')
                    ->label('Imagem')
                    ->square()
                    ->size(60),

                TextColumn::make('objective.title')
                    ->label('Objetivo')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success'),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->searchable(),

                ToggleColumn::make('is_active')
                    ->label('Ativo')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('objective_id')
                    ->label('Objetivo')
                    ->options(OdsObjective::pluck('title', 'id'))
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('is_active')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Apenas ativos')
                    ->falseLabel('Apenas inativos'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('order', 'asc')
            ->emptyStateHeading('Nenhuma meta cadastrada')
            ->emptyStateDescription('Comece por criar a primeira meta.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
