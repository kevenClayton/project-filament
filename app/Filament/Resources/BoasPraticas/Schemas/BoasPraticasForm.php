<?php

namespace App\Filament\Resources\BoasPraticas\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class BoasPraticasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações Básicas')
                    ->description('Informações principais da boa prática')
                    ->schema([
                        Hidden::make('empresa_id')
                            ->default(function () {
                                $user = Auth::user();
                                return $user && $user->company_id ? $user->company_id : null;
                            }),

                        TextInput::make('titulo')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('desafio_inicial')
                            ->label('Desafio Inicial')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('ambito_atuacao')
                            ->label('Âmbito de Atuação')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('atores_envolvidos')
                            ->label('Atores Envolvidos')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('contato')
                            ->label('Contacto')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Select::make('estado')
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

                Section::make('Objetivos')
                    ->description('Objetivos da boa prática')
                    ->schema([
                        Repeater::make('objetivos')
                            ->label('Objetivos')
                            ->schema([
                                TextInput::make('objetivo')
                                    ->label('Objetivo')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required()
                            ->minItems(1)
                            ->columnSpanFull(),
                    ]),

                Section::make('Ações e Resultados')
                    ->description('Ações implementadas e resultados obtidos')
                    ->schema([
                        Repeater::make('acoes')
                            ->label('Ações')
                            ->schema([
                                TextInput::make('acao')
                                    ->label('Ação')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('descricao')
                                    ->label('Descrição')
                                    ->rows(2),
                            ])
                            ->required()
                            ->minItems(1)
                            ->columnSpanFull(),

                        Repeater::make('resultados')
                            ->label('Resultados')
                            ->schema([
                                TextInput::make('resultado')
                                    ->label('Resultado')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('valor')
                                    ->label('Valor/Métrica')
                                    ->maxLength(100),
                            ])
                            ->required()
                            ->minItems(1)
                            ->columnSpanFull(),
                    ]),

                Section::make('Impacto e Indicadores')
                    ->description('Impacto nos ODS e indicadores de desempenho')
                    ->schema([
                        Repeater::make('impacto_ods')
                            ->label('Impacto nos ODS')
                            ->schema([
                                Select::make('ods')
                                    ->label('ODS')
                                    ->options([
                                        '1' => 'ODS 1 - Erradicar a pobreza',
                                        '2' => 'ODS 2 - Erradicar a fome',
                                        '3' => 'ODS 3 - Saúde de qualidade',
                                        '4' => 'ODS 4 - Educação de qualidade',
                                        '5' => 'ODS 5 - Igualdade de género',
                                        '6' => 'ODS 6 - Água potável e saneamento',
                                        '7' => 'ODS 7 - Energias renováveis e acessíveis',
                                        '8' => 'ODS 8 - Trabalho digno e crescimento económico',
                                        '9' => 'ODS 9 - Indústria, inovação e infraestruturas',
                                        '10' => 'ODS 10 - Reduzir as desigualdades',
                                        '11' => 'ODS 11 - Cidades e comunidades sustentáveis',
                                        '12' => 'ODS 12 - Produção e consumo sustentáveis',
                                        '13' => 'ODS 13 - Ação climática',
                                        '14' => 'ODS 14 - Proteger a vida marinha',
                                        '15' => 'ODS 15 - Proteger a vida terrestre',
                                        '16' => 'ODS 16 - Paz, justiça e instituições eficazes',
                                        '17' => 'ODS 17 - Parcerias para a implementação dos objetivos',
                                    ])
                                    ->required(),
                                Textarea::make('descricao_impacto')
                                    ->label('Descrição do Impacto')
                                    ->rows(2),
                            ])
                            ->columnSpanFull(),

                        Repeater::make('indicadores')
                            ->label('Indicadores')
                            ->schema([
                                TextInput::make('nome')
                                    ->label('Nome do Indicador')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('valor_inicial')
                                    ->label('Valor Inicial')
                                    ->maxLength(100),
                                TextInput::make('valor_atual')
                                    ->label('Valor Atual')
                                    ->maxLength(100),
                                TextInput::make('unidade')
                                    ->label('Unidade de Medida')
                                    ->maxLength(50),
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Aprendizagens e Próximos Passos')
                    ->description('Reflexões e planos futuros')
                    ->schema([
                        Textarea::make('aprendizagens')
                            ->label('Aprendizagens')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('testemunhos')
                            ->label('Testemunhos')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('proximos_passos')
                            ->label('Próximos Passos')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
