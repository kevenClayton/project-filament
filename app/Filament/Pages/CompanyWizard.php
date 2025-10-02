<?php

namespace App\Filament\Pages;

use App\Models\Company;
use BackedEnum;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Slider\Enums\PipsMode;

class CompanyWizard extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $title = 'Onboarding';
    protected ?string $heading = 'Onboarding';
    protected ?string $subheading = 'Finalize o cadastro da sua empresa para continuar';

    protected static bool $shouldRegisterNavigation = false;

    public string $view = 'filament.pages.company-wizard';

    public ?array $data = [];


    public function mount(): void
    {
        $user = Auth::user();

        // If user already has a completed company, redirect to dashboard
        if ($user->company_id && $user->company?->wizard_completed) {
            redirect()->route('filament.admin.pages.dashboard');
            return;
        }

        // Load existing company data if available
        if ($user->company_id && $user->company) {
            $this->form->fill($user->company->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Wizard::make([
                    Step::make('Perfil da Empresa')
                        ->icon('heroicon-o-building-office')
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
                                ->inline()
                                ->columnSpanFull(),

                            Radio::make('sustainability_policy')
                                ->label('A sua empresa possui uma política formal de sustentabilidade?')
                                ->options([
                                    'formal_documented' => 'Sim, formalmente documentada e implementada',
                                    'informal' => 'Adotada informalmente',
                                    'developing' => 'Em desenvolvimento',
                                    'none' => 'Não possui',
                                ])
                                ->required()
                                ->columnSpanFull(),
                        ]),

                    Step::make('Práticas Ambientais')
                        ->icon('heroicon-o-beaker')
                        ->schema([
                            Slider::make('energy_efficiency')
                                ->label('Medidas de eficiência energética')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->pips(PipsMode::Steps)
                                ->fillTrack()
                                ->columnSpanFull(),

                            Slider::make('waste_reduction')
                                ->label('Redução e reciclagem de resíduos')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->pips(PipsMode::Steps)
                                ->fillTrack()
                                ->columnSpanFull(),

                            Slider::make('renewable_energy')
                                ->label('Uso de energia renovável')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->pips(PipsMode::Steps)
                                ->fillTrack()
                                ->columnSpanFull(),

                            Slider::make('sustainable_purchases')
                                ->label('Compras com critérios sustentáveis')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->pips(PipsMode::Steps)
                                ->fillTrack()
                                ->columnSpanFull(),

                            Slider::make('co2_reduction')
                                ->label('Medidas para redução de emissões de CO2')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->pips(PipsMode::Steps)
                                ->fillTrack()
                                ->columnSpanFull(),

                            Slider::make('water_reduction')
                                ->label('Medidas para redução do consumo de água')
                                ->helperText('1 = nada implementado, 5 = totalmente implementado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->pips(PipsMode::Steps)
                                ->fillTrack()
                                ->columnSpanFull(),

                            Radio::make('environmental_monitoring')
                                ->label('A empresa monitora seu desempenho ambiental?')
                                ->options([
                                    'indicators_reports' => 'Sim, com indicadores ou relatórios',
                                    'occasional' => 'Avaliado ocasionalmente',
                                    'none' => 'Não monitora',
                                ])
                                ->required()
                                ->columnSpanFull(),

                        ]),

                    Step::make('Responsabilidade Social')
                        ->icon('heroicon-o-users')
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
                                ->columns(2)
                                ->columnSpanFull(),
                        ]),

                    Step::make('ESG e Governança')
                        ->icon('heroicon-o-shield-check')
                        ->schema([
                            Radio::make('esg_responsible')
                                ->label('Quem é responsável pelas questões ESG na empresa?')
                                ->options([
                                    'dedicated_team' => 'Equipe ou profissional dedicado',
                                    'general_management' => 'Faz parte da gestão geral',
                                    'none' => 'Ninguém responsável atualmente',
                                ])
                                ->required()
                                ->columnSpanFull(),

                            Radio::make('esg_goals')
                                ->label('A empresa definiu metas mensuráveis de ESG?')
                                ->options([
                                    'clear_monitored' => 'Sim, com metas claras e monitoradas',
                                    'informal' => 'Sim, mas informais',
                                    'none' => 'Não',
                                ])
                                ->required()
                                ->columnSpanFull(),

                            Radio::make('esg_communication')
                                ->label('Com que frequência sua empresa comunica suas ações de ESG?')
                                ->options([
                                    'regular' => 'Regularmente (ex: relatórios anuais)',
                                    'occasional' => 'Ocasionalmente',
                                    'never' => 'Nunca',
                                ])
                                ->required()
                                ->columnSpanFull(),

                            Radio::make('business_ethics')
                                ->label('A sua empresa possui políticas de ética nos negócios?')
                                ->options([
                                    'full_documented' => 'Sim, com políticas documentadas e completas',
                                    'partial' => 'Sim, mas apenas parcialmente',
                                    'developing' => 'Está em desenvolvimento',
                                    'none' => 'Não possui políticas específicas',
                                ])
                                ->required()
                                ->columnSpanFull(),
                        ]),

                    Step::make('Maturidade e Progresso')
                        ->icon('heroicon-o-presentation-chart-line')
                        ->schema([
                            Slider::make('sustainability_maturity')
                                ->label('Avalie o nível atual de maturidade da sua empresa em sustentabilidade')
                                ->helperText('1 = não iniciado, 5 = totalmente integrado')
                                ->minValue(1)
                                ->maxValue(5)
                                ->step(1)
                                ->default(1)
                                ->required()
                                ->columnSpanFull(),

                            Radio::make('publishes_esg_reports')
                                ->label('A empresa publica relatórios anuais de sustentabilidade (ESG)?')
                                ->boolean()
                                ->required()
                                ->columnSpanFull(),

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
                                ->visible(fn ($get) => $get('publishes_esg_reports'))
                                ->columns(2)
                                ->columnSpanFull(),

                            Radio::make('sustainability_evolution')
                                ->label('Como evoluiu a sustentabilidade vs ano anterior?')
                                ->options([
                                    'significant' => 'Progresso significativo',
                                    'moderate' => 'Progresso moderado',
                                    'none' => 'Sem mudanças',
                                    'regression' => 'Regressão',
                                ])
                                ->required()
                                ->columnSpanFull(),

                            CheckboxList::make('sustainability_challenges')
                                ->label('Maiores desafios para avançar em sustentabilidade (até 2):')
                                ->options([
                                    'knowledge_lack' => 'Falta de conhecimento técnico',
                                    'financial_constraints' => 'Restrições financeiras',
                                    'limited_hr' => 'Recursos humanos limitados',
                                    'low_market_demand' => 'Baixa demanda do mercado',
                                    'regulatory_uncertainty' => 'Incerteza regulatória',
                                ])
                                ->columns(2)
                                ->columnSpanFull(),

                            CheckboxList::make('sustainability_motivations')
                                ->label('O que motiva as ações de sustentabilidade?')
                                ->options([
                                    'brand_image' => 'Imagem da marca',
                                    'legal_compliance' => 'Conformidade legal',
                                    'cost_reduction' => 'Redução de custos',
                                    'stakeholder_pressure' => 'Pressão de stakeholders',
                                    'ethical_commitment' => 'Compromisso ético ou ambiental',
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ]),
                ])
                ->submitAction(view('filament.pages.company-wizard-submit-button'))
                ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();

        if ($user->company_id && $user->company) {
            // Update existing company
            $user->company->update(array_merge($data, [
                'wizard_completed' => true,
                'wizard_current_step' => 6,
            ]));
        } else {
            // Create new company
            $company = Company::create(array_merge($data, [
                'wizard_completed' => true,
                'wizard_current_step' => 6,
                'accepted_rgpd' => true,
            ]));

            // Associate user with company
            $user->update(['company_id' => $company->id]);
        }

        Notification::make()
            ->title('Configuração da empresa concluída!')
            ->success()
            ->send();

        // Redirect to dashboard
        $this->redirect(route('filament.admin.pages.dashboard'));
    }
}
