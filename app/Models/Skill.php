<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'level',
        'sort_order',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLevelLabelAttribute(): string
    {
        return match($this->level) {
            'debutant'      => 'Débutant',
            'intermediaire' => 'Intermédiaire',
            'avance'        => 'Avancé',
            'expert'        => 'Expert',
            default         => 'Intermédiaire',
        };
    }

    public function getLevelPercentageAttribute(): int
    {
        return match($this->level) {
            'debutant'      => 25,
            'intermediaire' => 50,
            'avance'        => 75,
            'expert'        => 100,
            default         => 50,
        };
    }
}
