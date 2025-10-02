<?php

namespace App\Filament\Resources\GoodPractices\Schemas;

use App\Models\OdsGoal;
use App\Models\OdsObjective;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class GoodPracticesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Informações Básicas')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                        Hidden::make('company_id')
                            ->default(function () {
                                $user = Auth::user();
                                return $user && $user->company_id ? $user->company_id : null;
                            }),

                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('initial_challenge')
                            ->label('Desafio Inicial')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('scope_of_action')
                            ->label('Âmbito de Atuação')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('actors_involved')
                            ->label('Atores Envolvidos')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('contact')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'draft' => 'Rascunho',
                                'published' => 'Publicado',
                                'archived' => 'Arquivado',
                            ])
                            ->default('draft')
                            ->required(),
                        ])
                        ->columns(2),

                    Step::make('Objetivos e Metas ODS')
                        ->icon('heroicon-o-flag')
                        ->schema([
                        Repeater::make('goals')
                            ->label('Metas ODS')
                            ->relationship()
                            ->schema([
                                Select::make('objective_id')
                                    ->label('Objetivo ODS')
                                    ->options(OdsObjective::where('is_active', true)->orderBy('order')->pluck('title', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(fn (callable $set) => $set('goal_id', null))
                                    ->columnSpanFull(),

                                Select::make('goal_id')
                                    ->label('Meta ODS')
                                    ->options(function (callable $get) {
                                        $objectiveId = $get('objective_id');
                                        if (!$objectiveId) {
                                            return [];
                                        }
                                        return OdsGoal::where('objective_id', $objectiveId)
                                            ->where('is_active', true)
                                            ->orderBy('order')
                                            ->pluck('title', 'id');
                                    })
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->disabled(fn (callable $get) => !$get('objective_id'))
                                    ->columnSpanFull(),

                                Textarea::make('action_description')
                                    ->label('Descrição da Ação')
                                    ->helperText('Descreva como esta prática contribui para atingir esta meta')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->addActionLabel('Adicionar Meta ODS')
                            ->defaultItems(1)
                            ->columnSpanFull()
                            ->columns(1),
                        ]),

                    Step::make('Objetivos')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->schema([
                        Repeater::make('objectives')
                            ->label('Objetivos')
                            ->schema([
                                TextInput::make('objective')
                                    ->label('Objetivo')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required()
                            ->minItems(1)
                            ->columnSpanFull(),
                        ]),

                    Step::make('Ações e Resultados')
                        ->icon('heroicon-o-rocket-launch')
                        ->schema([
                        Repeater::make('actions')
                            ->label('Ações')
                            ->schema([
                                TextInput::make('action')
                                    ->label('Ação')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->label('Descrição')
                                    ->rows(2),
                            ])
                            ->required()
                            ->minItems(1)
                            ->columnSpanFull(),

                        Repeater::make('results')
                            ->label('Resultados')
                            ->schema([
                                TextInput::make('result')
                                    ->label('Resultado')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('value')
                                    ->label('Valor/Métrica')
                                    ->maxLength(100),
                            ])
                            ->required()
                            ->minItems(1)
                            ->columnSpanFull(),
                        ]),

                    Step::make('Indicadores')
                        ->icon('heroicon-o-chart-bar')
                        ->schema([
                        Repeater::make('indicators')
                            ->label('Indicadores')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nome do Indicador')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('initial_value')
                                    ->label('Valor Inicial')
                                    ->maxLength(100),
                                TextInput::make('current_value')
                                    ->label('Valor Atual')
                                    ->maxLength(100),
                                TextInput::make('unit')
                                    ->label('Unidade de Medida')
                                    ->maxLength(50),
                            ])
                            ->columnSpanFull(),
                        ]),

                    Step::make('Aprendizagens e Próximos Passos')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                        Textarea::make('learnings')
                            ->label('Aprendizagens')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('testimonials')
                            ->label('Testemunhos')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('next_steps')
                            ->label('Próximos Passos')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        ]),
                ])
                ->columnSpanFull(),
            ]);
    }
}

