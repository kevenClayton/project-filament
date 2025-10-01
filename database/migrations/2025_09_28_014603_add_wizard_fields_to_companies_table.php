<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Step 1: Perfil da Empresa
            $table->string('phone')->nullable()->after('contact_phone');
            $table->string('address')->nullable()->after('phone');
            $table->string('postal_code')->nullable()->after('address');
            $table->string('municipality')->nullable()->after('postal_code');
            $table->string('headquarters_municipality')->nullable()->after('municipality');
            $table->json('knowledge_source')->nullable()->after('headquarters_municipality'); // Como conheceu a empresa

            // Step 2: Tamanho e Política
            $table->enum('company_size', ['micro', 'pequena', 'media', 'grande'])->nullable()->after('knowledge_source');
            $table->enum('sustainability_policy', ['formal_documented', 'informal', 'developing', 'none'])->nullable()->after('company_size');

            // Step 3: Práticas Ambientais (sliders 1-5)
            $table->integer('energy_efficiency')->nullable()->after('sustainability_policy');
            $table->integer('waste_reduction')->nullable()->after('energy_efficiency');
            $table->integer('renewable_energy')->nullable()->after('waste_reduction');
            $table->integer('sustainable_purchases')->nullable()->after('renewable_energy');
            $table->integer('co2_reduction')->nullable()->after('sustainable_purchases');
            $table->integer('water_reduction')->nullable()->after('co2_reduction');
            $table->enum('environmental_monitoring', ['indicators_reports', 'occasional', 'none'])->nullable()->after('water_reduction');

            // Step 4: Responsabilidade Social
            $table->json('employee_practices')->nullable()->after('environmental_monitoring'); // Práticas com funcionários

            // Step 5: ESG e Governança
            $table->enum('esg_responsible', ['dedicated_team', 'general_management', 'none'])->nullable()->after('employee_practices');
            $table->enum('esg_goals', ['clear_monitored', 'informal', 'none'])->nullable()->after('esg_responsible');
            $table->enum('esg_communication', ['regular', 'occasional', 'never'])->nullable()->after('esg_goals');
            $table->enum('business_ethics', ['full_documented', 'partial', 'developing', 'none'])->nullable()->after('esg_communication');

            // Step 6: Maturidade e Progresso
            $table->integer('sustainability_maturity')->nullable()->after('business_ethics'); // 1-5
            $table->boolean('publishes_esg_reports')->nullable()->after('sustainability_maturity');
            $table->json('esg_frameworks')->nullable()->after('publishes_esg_reports'); // Frameworks utilizados
            $table->enum('sustainability_evolution', ['significant', 'moderate', 'none', 'regression'])->nullable()->after('esg_frameworks');
            $table->json('sustainability_challenges')->nullable()->after('sustainability_evolution'); // Até 2 desafios
            $table->json('sustainability_motivations')->nullable()->after('sustainability_challenges'); // Múltiplas motivações

            // Controle do wizard
            $table->boolean('wizard_completed')->default(false)->after('sustainability_motivations');
            $table->integer('wizard_current_step')->default(1)->after('wizard_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'address', 'postal_code', 'municipality', 'headquarters_municipality',
                'knowledge_source', 'company_size', 'sustainability_policy',
                'energy_efficiency', 'waste_reduction', 'renewable_energy', 'sustainable_purchases',
                'co2_reduction', 'water_reduction', 'environmental_monitoring',
                'employee_practices', 'esg_responsible', 'esg_goals', 'esg_communication',
                'business_ethics', 'sustainability_maturity', 'publishes_esg_reports',
                'esg_frameworks', 'sustainability_evolution', 'sustainability_challenges',
                'sustainability_motivations', 'wizard_completed', 'wizard_current_step'
            ]);
        });
    }
};
