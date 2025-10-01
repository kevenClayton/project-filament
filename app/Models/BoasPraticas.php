<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoasPraticas extends Model
{
    use HasFactory;

    protected $table = 'boas_praticas';

    protected $fillable = [
        'empresa_id',
        'titulo',
        'desafio_inicial',
        'ambito_atuacao',
        'atores_envolvidos',
        'objetivos',
        'acoes',
        'resultados',
        'impacto_ods',
        'indicadores',
        'aprendizagens',
        'testemunhos',
        'proximos_passos',
        'contato',
        'estado',
    ];

    protected $casts = [
        'objetivos' => 'array',
        'acoes' => 'array',
        'resultados' => 'array',
        'impacto_ods' => 'array',
        'indicadores' => 'array',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'empresa_id');
    }
}
