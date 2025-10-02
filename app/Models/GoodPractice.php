<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GoodPractice extends Model
{
    use HasFactory;

    protected $table = 'good_practices';

    protected $fillable = [
        'company_id',
        'title',
        'initial_challenge',
        'scope_of_action',
        'actors_involved',
        'objectives',
        'actions',
        'results',
        'ods_impact',
        'indicators',
        'learnings',
        'testimonials',
        'next_steps',
        'contact',
        'status',
    ];

    protected $casts = [
        'objectives' => 'array',
        'actions' => 'array',
        'results' => 'array',
        'ods_impact' => 'array',
        'indicators' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function goals(): BelongsToMany
    {
        return $this->belongsToMany(OdsGoal::class, 'good_practices_goals', 'good_practice_id', 'goal_id')
            ->withPivot('action_description')
            ->withTimestamps();
    }
}

