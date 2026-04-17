<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_path',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class)->orderBy('sort_order')->orderByDesc('start_date');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class)->orderBy('sort_order')->orderByDesc('graduation_year');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class)->orderBy('sort_order');
    }

    public function hobbies(): HasMany
    {
        return $this->hasMany(Hobby::class)->orderBy('sort_order');
    }

    public function cvSetting(): HasOne
    {
        return $this->hasOne(CvSetting::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo_path && Storage::disk('public')->exists($this->photo_path)) {
            // Pour le PDF, utiliser le chemin absolu du système de fichiers
            if (request()->routeIs('dashboard.cv.download') || (request()->get('forPdf') ?? false)) {
                return storage_path('app/public/' . $this->photo_path);
            }
            // Pour le web, utiliser l'URL relative
            return '/storage/' . $this->photo_path;
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=2563eb&color=fff&size=200';
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            CvSetting::create(['user_id' => $user->id]);
        });
    }
}
