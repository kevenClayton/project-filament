<?php

namespace App\Filament\Resources\OdsObjectives\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OdsObjectivesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Objetivo')
                    ->schema([
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
                            ->directory('ods-objectives')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->columnSpanFull(),

                        TextInput::make('order')
                            ->label('Ordem')
                            ->numeric()
                            ->default(0)
                            ->helperText('Ordem de exibição do objetivo'),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true)
                            ->helperText('Objetivos inativos não aparecem para os utilizadores'),
                    ])
                    ->columns(2),
            ]);
    }
}

