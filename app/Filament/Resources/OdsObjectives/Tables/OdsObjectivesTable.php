<?php

namespace App\Filament\Resources\OdsObjectives\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OdsObjectivesTable
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

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('goals_count')
                    ->label('Metas')
                    ->counts('goals')
                    ->badge()
                    ->color('success'),

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
                TernaryFilter::make('is_active')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Apenas ativos')
                    ->falseLabel('Apenas inativos'),
            ])
            ->actions([
                \Filament\Tables\Actions\ViewAction::make(),
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc')
            ->emptyStateHeading('Nenhum objetivo cadastrado')
            ->emptyStateDescription('Comece por criar o primeiro objetivo.')
            ->emptyStateIcon('heroicon-o-flag');
    }
}
