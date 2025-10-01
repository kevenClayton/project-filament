<?php

namespace App\Filament\Pages;

use App\Models\Company;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Slider\Enums\PipsMode;

class CompanyWizard extends Page implements HasForms, HasActions
{
    use InteractsWithForms, InteractsWithActions;

    protected static ?string $title = 'Dashboard';
    protected static bool $shouldRegisterNavigation = false;


    public function getView(): string
    {
        return 'filament.pages.company-wizard';
    }

    public function mount(): void
    {
        $user = Auth::user();
        if ($user && (! $user->company_id || ! $user->company || ! $user->company->wizard_completed)) {
            // Define a ação padrão que será aberta automaticamente
            $this->mountAction('companyWizard');
        }
    }

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        $needsWizard = $user && (!$user->company_id || !$user->company || !$user->company->wizard_completed);

        return [
            $this->companyWizardAction()->hidden(fn() => !$needsWizard),
        ];
    }

    public function companyWizardAction(): Action
    {
        return Action::make('companyWizard')
            ->label('Configurar Empresa')
            ->icon('heroicon-o-building-office')
            ->color('primary')
            ->size('sm')
            ->modalHeading('Configuração da Empresa')
            ->modalDescription('Complete as informações da sua empresa seguindo os steps')
            ->modalWidth('7xl')
            ->modalSubmitActionLabel('Salvar')
            ->modalCancelAction(false)
            ->modalCloseButton(false)
            ->closeModalByClickingAway(false)
            ->closeModalByEscaping(false)
            ->form([
                Wizard::make([
                    Step::make('Perfil da Empresa')
                        ->icon('heroicon-o-building-office')
                        // ->description('Informações básicas da empresa')
                        ->schema([
                            TextInput::make('name')
                                ->label('Nome da Empresa')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            TextInput::make('contact_phone')
                                ->label('Contacto Telefónico')
                                ->tel()
                                ->required(),

                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required(),

                            TextInput::make('postal_code')
                                ->label('Código Postal')
                                ->required(),

                            TextInput::make('address')
                                ->label('Morada (Rua)')
                                ->required(),

                            TextInput::make('municipality')
                                ->label('Concelho')
                                ->required(),

                            TextInput::make('headquarters_municipality')
                                ->label('Concelho da Sede da Empresa')
                                ->required(),

                            CheckboxList::make('knowledge_source')
                                ->label('Teve conhecimento do Lisboa Sustentável Empresas através...')
                                ->options([
                                    'website' => 'do Website Lisboa Sustentável Empresas',
                                    'social_media' => 'das Redes Sociais',
                                    'newsletter' => 'de Newsletter / E-mail que recebi',
                                    'direct_invite' => 'de Convite direto',
                                    'event' => 'De um Evento em que participei',
                                    'other' => 'Outro',
                                ])
                                ->required()
                                ->columns(2)
                                ->columnSpanFull(),
                        ])
                        ->columns(2),

                    Step::make('Tamanho e Política')
                        ->icon('heroicon-o-chart-bar')
                        // ->description('Informações sobre o tamanho e políticas')
                        ->schema([
                            Radio::make('company_size')
                                ->label('Tamanho da empresa (número de funcionários)')
                                ->options([
                                    'micro' => 'Micro (1–9)',
                                    'pequena' => 'Pequena (10–50)',
                                    'media' => 'Média (51–250)',
                                    'grande' => 'Grande (251+)',
                                ])
                                ->required()
                                ->inline(),

                            Radio::make('sustainability_policy')
                                ->label('A sua empresa possui uma política formal de sustentabilidade?')
                                ->options([
                                    'formal_documented' => 'Sim, formalmente documentada e implementada',
                                    'informal' => 'Adotada informalmente',
                                    'developing' => 'Em desenvolvimento',
                                    'none' => 'Não possui',
                                ])
                                ->required(),
                        ]),

                    Step::make('Práticas Ambientais')
                        ->icon('heroicon-o-beaker')
                        // ->description('Avaliação das práticas ambientais')
                        ->schema([
                            Slider::make('energy_efficiency')
                                ->label('Medidas de eficiência energética')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->tooltips()
                                ->pips(PipsMode::Steps)
                                ->fillTrack(),

                            Slider::make('waste_reduction')
                                ->label('Redução e reciclagem de resíduos')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->tooltips()
                                ->pips(PipsMode::Steps)
                                ->fillTrack(),

                            Slider::make('renewable_energy')
                                ->label('Uso de energia renovável')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->tooltips()
                                ->pips(PipsMode::Steps)
                                ->fillTrack(),

                            Slider::make('sustainable_purchases')
                                ->label('Compras com critérios sustentáveis')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->tooltips()
                                ->pips(PipsMode::Steps)
                                ->fillTrack(),

                            Slider::make('co2_reduction')
                                ->label('Medidas para redução de emissões de CO2')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->tooltips()
                                ->pips(PipsMode::Steps)
                                ->fillTrack(),

                            Slider::make('water_reduction')
                                ->label('Medidas para redução do consumo de água')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->tooltips()
                                ->pips(PipsMode::Steps)
                                ->fillTrack(),

                            Radio::make('environmental_monitoring')
                                ->label('A empresa monitora seu desempenho ambiental?')
                                ->options([
                                    'indicators_reports' => 'Sim, com indicadores ou relatórios',
                                    'occasional' => 'Avaliado ocasionalmente',
                                    'none' => 'Não monitora',
                                ]),
                        ]),

                    Step::make('Responsabilidade Social')
                        ->icon('heroicon-o-users')
                        // ->description('Práticas com funcionários')
                        ->schema([
                            CheckboxList::make('employee_practices')
                                ->label('Quais das seguintes práticas com funcionários são implementadas pela sua empresa?')
                                ->options([
                                    'fair_wages' => 'Salários e benefícios justos',
                                    'diversity' => 'Políticas de diversidade e inclusão',
                                    'health_safety' => 'Saúde e segurança no trabalho',
                                    'sustainability_training' => 'Capacitação em sustentabilidade',
                                    'none' => 'Nenhuma das anteriores',
                                ])
                                ->columns(2),
                        ]),

                    Step::make('ESG e Governança')
                        ->icon('heroicon-o-shield-check')
                        // ->description('Questões de ESG e ética empresarial')
                        ->schema([
                            Radio::make('esg_responsible')
                                ->label('Quem é responsável pelas questões ESG na empresa?')
                                ->options([
                                    'dedicated_team' => 'Equipe ou profissional dedicado',
                                    'general_management' => 'Faz parte da gestão geral',
                                    'none' => 'Ninguém responsável atualmente',
                                ])
                                ->required(),

                            Radio::make('esg_goals')
                                ->label('A empresa definiu metas mensuráveis de ESG?')
                                ->options([
                                    'clear_monitored' => 'Sim, com metas claras e monitoradas',
                                    'informal' => 'Sim, mas informais',
                                    'none' => 'Não',
                                ])
                                ->required(),

                            Radio::make('esg_communication')
                                ->label('Com que frequência sua empresa comunica suas ações de ESG?')
                                ->options([
                                    'regular' => 'Regularmente (ex: relatórios anuais)',
                                    'occasional' => 'Ocasionalmente',
                                    'never' => 'Nunca',
                                ])
                                ->required(),

                            Radio::make('business_ethics')
                                ->label('A sua empresa possui políticas de ética nos negócios?')
                                ->options([
                                    'full_documented' => 'Sim, com políticas documentadas e completas',
                                    'partial' => 'Sim, mas apenas parcialmente',
                                    'developing' => 'Está em desenvolvimento',
                                    'none' => 'Não possui políticas específicas',
                                ])
                                ->required(),
                        ]),

                    Step::make('Maturidade e Progresso')
                        ->icon('heroicon-o-presentation-chart-line')
                        // ->description('Avaliação final da maturidade')
                        ->schema([
                            Slider::make('sustainability_maturity')
                                ->label('Avalie o nível atual de maturidade da sua empresa em sustentabilidade')
                                ->helperText('1 = não iniciado, 5 = totalmente integrado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->required(),

                            Radio::make('publishes_esg_reports')
                                ->label('A empresa publica relatórios anuais de sustentabilidade (ESG)?')
                                ->boolean()
                                ->required(),

                            CheckboxList::make('esg_frameworks')
                                ->label('Em que norma ou framework o relatório se baseia?')
                                ->options([
                                    'gri' => 'GRI – Global Reporting Initiative',
                                    'esrs_csrd' => 'ESRS / CSRD – European Standards',
                                    'sasb' => 'SASB – Sustainability Accounting Standards',
                                    'tcfd' => 'TCFD – Task Force on Climate Disclosures',
                                    'b_corp' => 'B-Corp',
                                    'other' => 'Outra norma',
                                    'none_specific' => 'Não se baseia em norma específica',
                                ])
                                ->visible(fn($get) => $get('publishes_esg_reports'))
                                ->columns(2),

                            Radio::make('sustainability_evolution')
                                ->label('Como evoluiu a sustentabilidade vs ano anterior?')
                                ->options([
                                    'significant' => 'Progresso significativo',
                                    'moderate' => 'Progresso moderado',
                                    'none' => 'Sem mudanças',
                                    'regression' => 'Regressão',
                                ])
                                ->required(),

                            CheckboxList::make('sustainability_challenges')
                                ->label('Maiores desafios para avançar em sustentabilidade (até 2):')
                                ->options([
                                    'knowledge_lack' => 'Falta de conhecimento técnico',
                                    'financial_constraints' => 'Restrições financeiras',
                                    'limited_hr' => 'Recursos humanos limitados',
                                    'low_market_demand' => 'Baixa demanda do mercado',
                                    'regulatory_uncertainty' => 'Incerteza regulatória',
                                ])
                                ->columns(2),

                            CheckboxList::make('sustainability_motivations')
                                ->label('O que motiva as ações de sustentabilidade?')
                                ->options([
                                    'brand_image' => 'Imagem da marca',
                                    'legal_compliance' => 'Conformidade legal',
                                    'cost_reduction' => 'Redução de custos',
                                    'stakeholder_pressure' => 'Pressão de stakeholders',
                                    'ethical_commitment' => 'Compromisso ético ou ambiental',
                                ])
                                ->columns(2),
                        ]),
                ])
            ])
            ->fillForm(function (): array {
                $user = Auth::user();
                if ($user && $user->company_id && $user->company) {
                    return $user->company->toArray();
                }
                return [];
            })
            ->action(function (array $data): void {
                $user = Auth::user();

                if ($user && $user->company_id && $user->company) {
                    // Atualizar empresa existente
                    $user->company->update(array_merge($data, [
                        'wizard_completed' => true,
                        'wizard_current_step' => 6,
                    ]));
                } else {
                    // Criar nova empresa
                    $company = Company::create(array_merge($data, [
                        'wizard_completed' => true,
                        'wizard_current_step' => 6,
                        'accepted_rgpd' => true,
                    ]));

                    // Associar usuário à empresa
                    $user->update(['company_id' => $company->id]);
                }

                Notification::make()
                    ->title('Configuração da empresa concluída!')
                    ->success()
                    ->send();

                // Redireciona para dashboard
                $this->redirect(route('filament.admin.pages.dashboard'));
            });
    }
}
