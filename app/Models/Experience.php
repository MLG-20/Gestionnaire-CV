<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_title',
        'company',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_current' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDateRangeAttribute(): string
    {
        // S'assurer que la locale est française pour les noms de mois
        \Carbon\Carbon::setLocale('fr');
        
        $start = $this->start_date?->translatedFormat('M Y') ?? '';
        if ($this->is_current) {
            return $start . ' - Présent';
        }
        $end = $this->end_date?->translatedFormat('M Y') ?? '';
        return $start . ($end ? ' - ' . $end : '');
    }
}
