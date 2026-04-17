<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CvSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'template_name',
        'primary_color',
        'secondary_color',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function availableTemplates(): array
    {
        return [
            // --- Classiques ---
            ['slug' => 'bold',        'name' => 'Audacieux',    'style' => 'Typographie forte',         'category' => 'classic'],
            ['slug' => 'classic',     'name' => 'Classique',    'style' => 'Sobre & Professionnel',      'category' => 'classic'],
            ['slug' => 'clean',       'name' => 'Clean',        'style' => 'Cartes arrondies',          'category' => 'classic'],
            ['slug' => 'creative',    'name' => 'Créatif',      'style' => 'Bande pleine couleur',      'category' => 'classic'],
            ['slug' => 'elegant',     'name' => 'Élégant',      'style' => 'Raffiné & distinction',     'category' => 'classic'],
            ['slug' => 'minimalist',  'name' => 'Minimaliste',  'style' => 'Typographique & épuré',     'category' => 'classic'],
            ['slug' => 'modern',      'name' => 'Moderne',      'style' => 'Colonne latérale colorée',  'category' => 'classic'],
            ['slug' => 'professional', 'name' => 'Professionnel', 'style' => 'Design moderne à deux colonnes', 'category' => 'classic'],
            ['slug' => 'sidebar',     'name' => 'Sidebar',      'style' => 'Deux colonnes complètes',   'category' => 'classic'],
            ['slug' => 'template3',   'name' => 'Template 3',   'style' => 'Design zigzag cyan & noir',   'category' => 'classic'],
        ];
    }
}
