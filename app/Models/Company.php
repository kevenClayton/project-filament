<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nif',
        'email',
        'sector_activity',
        'size',
        'location',
        'contact_email',
        'contact_phone',
        'logo',
        'sustainability_policy_state',
        'accepted_rgpd',
        'is_active',

        // Wizard fields
        'phone',
        'address',
        'postal_code',
        'municipality',
        'headquarters_municipality',
        'knowledge_source',
        'company_size',
        'sustainability_policy',
        'energy_efficiency',
        'waste_reduction',
        'renewable_energy',
        'sustainable_purchases',
        'co2_reduction',
        'water_reduction',
        'environmental_monitoring',
        'employee_practices',
        'esg_responsible',
        'esg_goals',
        'esg_communication',
        'business_ethics',
        'sustainability_maturity',
        'publishes_esg_reports',
        'esg_frameworks',
        'sustainability_evolution',
        'sustainability_challenges',
        'sustainability_motivations',
        'wizard_completed',
        'wizard_current_step',
    ];

    protected $casts = [
        'accepted_rgpd' => 'boolean',
        'is_active' => 'boolean',
        'knowledge_source' => 'array',
        'employee_practices' => 'array',
        'esg_frameworks' => 'array',
        'sustainability_challenges' => 'array',
        'sustainability_motivations' => 'array',
        'wizard_completed' => 'boolean',
        'publishes_esg_reports' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function goodPractices(): HasMany
    {
        return $this->hasMany(GoodPractice::class, 'company_id');
    }

    public function isWizardCompleted(): bool
    {
        return $this->wizard_completed ?? false;
    }

    public function getCurrentStep(): int
    {
        return $this->wizard_current_step ?? 1;
    }
}
