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
        Schema::create('boas_praticas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('companies')->onDelete('cascade');
            $table->string('titulo');
            $table->text('desafio_inicial');
            $table->text('ambito_atuacao');
            $table->text('atores_envolvidos');
            $table->json('objetivos');
            $table->json('acoes');
            $table->json('resultados');
            $table->json('impacto_ods');
            $table->json('indicadores');
            $table->text('aprendizagens');
            $table->text('testemunhos');
            $table->text('proximos_passos');
            $table->string('contato');
            $table->string('estado')->default('draft'); // draft, published, archived
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boas_praticas');
    }
};
