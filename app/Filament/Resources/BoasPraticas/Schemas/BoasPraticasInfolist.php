<?php

namespace App\Filament\Resources\BoasPraticas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BoasPraticasInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('empresa.name')
                    ->label('Empresa'),
                TextEntry::make('titulo'),
                TextEntry::make('desafio_inicial')
                    ->columnSpanFull(),
                TextEntry::make('ambito_atuacao')
                    ->columnSpanFull(),
                TextEntry::make('atores_envolvidos')
                    ->columnSpanFull(),
                TextEntry::make('aprendizagens')
                    ->columnSpanFull(),
                TextEntry::make('testemunhos')
                    ->columnSpanFull(),
                TextEntry::make('proximos_passos')
                    ->columnSpanFull(),
                TextEntry::make('contato'),
                TextEntry::make('estado'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
