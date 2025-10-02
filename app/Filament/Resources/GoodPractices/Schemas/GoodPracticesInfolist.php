<?php

namespace App\Filament\Resources\GoodPractices\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GoodPracticesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações Básicas')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Título'),

                        TextEntry::make('company.name')
                            ->label('Empresa'),

                        TextEntry::make('status')
                            ->label('Estado')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match($state) {
                                'draft' => 'Rascunho',
                                'published' => 'Publicado',
                                'archived' => 'Arquivado',
                                default => $state,
                            })
                            ->color(fn ($state) => match($state) {
                                'draft' => 'warning',
                                'published' => 'success',
                                'archived' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('initial_challenge')
                            ->label('Desafio Inicial')
                            ->columnSpanFull(),

                        TextEntry::make('scope_of_action')
                            ->label('Âmbito de Atuação')
                            ->columnSpanFull(),

                        TextEntry::make('actors_involved')
                            ->label('Atores Envolvidos')
                            ->columnSpanFull(),

                        TextEntry::make('contact')
                            ->label('Contacto'),
                    ])
                    ->columns(2),

                Section::make('Metas ODS')
                    ->schema([
                        RepeatableEntry::make('goals')
                            ->label('Metas')
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Meta')
                                    ->weight('bold'),
                                TextEntry::make('objective.title')
                                    ->label('Objetivo')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('pivot.action_description')
                                    ->label('Descrição da Ação')
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Aprendizagens e Próximos Passos')
                    ->schema([
                        TextEntry::make('learnings')
                            ->label('Aprendizagens')
                            ->columnSpanFull(),

                        TextEntry::make('testimonials')
                            ->label('Testemunhos')
                            ->columnSpanFull(),

                        TextEntry::make('next_steps')
                            ->label('Próximos Passos')
                            ->columnSpanFull(),
                    ]),

                Section::make('Informações do Sistema')
                    ->schema([
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

