<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Component;
use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Register extends BaseRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getCargoFormComponent(),
                $this->getEmailFormComponent(),
                $this->getTelefoneFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getResponsabilidadeSustentabilidadeFormComponent(),
            ]);
    }

    protected function getCargoFormComponent(): Component
    {
        return TextInput::make('position')
            ->label('Cargo')
            ->required()
            ->maxLength(255);
    }

    protected function getTelefoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->label('Telefone')
            ->tel()
            ->required()
            ->maxLength(20);
    }

    protected function getResponsabilidadeSustentabilidadeFormComponent(): Component
    {
        //Em ingles, nome do banco, não exibindo pro cliente
        return Checkbox::make('responsibility_sustainability')
            ->label('Com responsabilidade na sustentabilidade?')
            ->helperText('Marque se você tem responsabilidades relacionadas à sustentabilidade');
    }

    protected function handleRegistration(array $data): Model
    {
        return User::create($data);
    }

    protected function getRedirectUrl(): string
    {
        // Sempre redireciona para dashboard, que vai verificar se precisa ir para o wizard
        return route('filament.admin.pages.dashboard');
    }
}
