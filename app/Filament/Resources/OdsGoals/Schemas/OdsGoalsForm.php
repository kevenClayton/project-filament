<?php

namespace App\Filament\Resources\OdsGoals\Schemas;

use App\Models\OdsObjective;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OdsGoalsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Meta')
                    ->schema([
                        Select::make('objective_id')
                            ->label('Objetivo')
                            ->options(OdsObjective::where('is_active', true)->pluck('title', 'id'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),

                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Imagem')
                            ->image()
                            ->directory('ods-goals')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->columnSpanFull(),

                        TextInput::make('order')
                            ->label('Ordem')
                            ->numeric()
                            ->default(0)
                            ->helperText('Ordem de exibição da meta'),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true)
                            ->helperText('Metas inativas não aparecem para os utilizadores'),
                    ])
                    ->columns(2),
            ]);
    }
}

