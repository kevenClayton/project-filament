<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OdsGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'objective_id',
        'title',
        'description',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function objective(): BelongsTo
    {
        return $this->belongsTo(OdsObjective::class, 'objective_id');
    }
}

