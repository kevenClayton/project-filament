<?php

namespace App\Filament\Resources\OdsObjectives\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OdsObjectivesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalhes do Objetivo')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Título'),

                        TextEntry::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),

                        ImageEntry::make('image')
                            ->label('Imagem')
                            ->size(200),

                        TextEntry::make('order')
                            ->label('Ordem')
                            ->badge(),

                        TextEntry::make('is_active')
                            ->label('Estado')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Ativo' : 'Inativo')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),

                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Atualizado em')
                            ->dateTime('d/m/Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }
}

