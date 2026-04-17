# 🔒 Guide Sécurité & Scalabilité - Sama CV

## 1. 🔐 SÉCURITÉ

### 1.1 Configuration Sécurisée (.env)

✅ **À faire** (actuellement):
```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xxxxx (généré)
CACHE_STORE=database
SESSION_DRIVER=database
```

⚠️ **À améliorer**:
```env
# Réduire la session lifetime en production
SESSION_LIFETIME=30

# Ajouter variables pour taux de limitation
RATE_LIMIT_LOGIN=5
RATE_LIMIT_API=60

# Variables de CORS (si API future)
CORS_ALLOWED_ORIGINS=https://example.com

# Clé d'application - JAMAIS en plaintext
APP_KEY=base64:xxxxx

# Admin credentials - utiliser un vault/secrets manager en production
ADMIN_EMAIL=admin@samacv.com
ADMIN_PASSWORD=password  # À REMPLACER par hash bcrypt avec env spécifique
```

### 1.2 Headers de Sécurité HTTP

**À ajouter** dans `config/app.php` ou middleware:
```php
// app/Http/Middleware/SecurityHeaders.php
public function handle(Request $request, Closure $next)
{
    $response = $next($request);
    
    // Prévenir le clickjacking
    $response->header('X-Frame-Options', 'DENY');
    
    // Prévenir le MIME type sniffing
    $response->header('X-Content-Type-Options', 'nosniff');
    
    // Protection XSS
    $response->header('X-XSS-Protection', '1; mode=block');
    
    // Content Security Policy
    $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' fonts.bunny.net; font-src fonts.bunny.net;");
    
    // Referrer Policy
    $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');
    
    // HSTS (HTTPS Only)
    $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
    
    // Permissions Policy
    $response->header('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
    
    return $response;
}

// Enregistrer dans app/Http/Kernel.php:
protected $middleware = [
    // ...
    \App\Http\Middleware\SecurityHeaders::class,
];
```

### 1.3 CSRF Protection

✅ **Actuellement activé** par défaut dans Laravel 12

À vérifier dans toutes les formes:
```blade
@csrf <!-- Présent dans tous vos formulaires -->
```

### 1.4 Validation des Entrées

**À améliorer** dans les contrôleurs:

```php
// Exemple: Profile Controller
public function update(Request $request)
{
    // ✅ Validation stricte
    $validated = $request->validate([
        'first_name' => 'required|string|max:100|regex:/^[a-zA-ZÀ-ÿ\s\-\']+$/',
        'last_name' => 'required|string|max:100|regex:/^[a-zA-ZÀ-ÿ\s\-\']+$/',
        'email' => 'required|email:rfc,dns|unique:users,email,' . auth()->id(),
        'phone' => 'nullable|string|regex:/^[\d\s\-\+\.()]{10,20}$/',
        'location' => 'nullable|string|max:100',
        'bio' => 'nullable|string|max:500',
        'professional_title' => 'nullable|string|max:100',
        // Validation des couleurs (hex)
        'primary_color' => 'regex:/^#[0-9A-Fa-f]{6}$/',
        'secondary_color' => 'regex:/^#[0-9A-Fa-f]{6}$/',
    ]);
    
    // ✅ Utiliser mass assignment protection
    // Dans User.php:
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone',
        'location', 'bio', 'professional_title'
    ];
    
    // ✅ Ne jamais faire:
    // $user->update($request->all()); // DANGER!
    
    // ✅ À faire:
    $user->update($validated);
}
```

### 1.5 Upload de Fichiers (Photo)

**Sécuriser le controller**:
```php
// app/Http/Controllers/ProfileController.php
public function updatePhoto(Request $request)
{
    $validated = $request->validate([
        'photo' => [
            'required',
            'image',
            'mimes:jpeg,png,webp', // Whitelist de types
            'max:5120', // 5MB max
            'dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'
        ]
    ]);
    
    // ✅ Supprimer l'ancienne photo
    if (auth()->user()->photo_path) {
        Storage::disk('public')->delete(auth()->user()->photo_path);
    }
    
    // ✅ Générer un nom unique et sûr
    $filename = 'photos/' . auth()->id() . '/' . 
                Str::uuid() . '.' . 
                $validated['photo']->extension();
    
    // ✅ Stocker le fichier
    $path = $validated['photo']->storeAs(
        'photos/' . auth()->id(),
        Str::uuid() . '.' . $validated['photo']->extension(),
        'public'
    );
    
    auth()->user()->update(['photo_path' => $path]);
    
    return redirect()->back()->with('success', 'Photo mise à jour');
}

// Protéger l'accès au fichier dans routes/web.php:
Route::get('/storage/photos/{userId}/{filename}', function($userId, $filename) {
    // ✅ Vérifier que l'utilisateur accède à sa propre photo
    if (auth()->id() !== (int)$userId && !auth()->user()->is_admin) {
        abort(403);
    }
    
    $path = "photos/{$userId}/{$filename}";
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    
    return Storage::disk('public')->download($path);
})->middleware('auth');
```

### 1.6 Authentification & Autorisation

**À améliorer** dans `app/Policies/`:

```php
// app/Policies/ProfilePolicy.php
<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy
{
    // ✅ Seul l'utilisateur peut voir/modifier son profil
    public function update(User $user, User $target): bool
    {
        return $user->id === $target->id;
    }
    
    public function delete(User $user, User $target): bool
    {
        return $user->id === $target->id;
    }
}

// Utiliser dans le contrôleur:
public function update(Request $request, User $user)
{
    $this->authorize('update', $user); // Gate + Policy
    // ...
}
```

### 1.7 Chiffrement des Données Sensibles

```php
// Ajouter dans les modèles sensibles
use Illuminate\Database\Eloquent\Casts\Encrypted;

class User extends Model
{
    protected $casts = [
        'email' => 'encrypted',
        'phone' => 'encrypted', // Optional
        'password' => 'hashed',
    ];
}

// Dans les migrations:
Schema::table('users', function (Blueprint $table) {
    // Les colonnes chiffrées utilisent 255 chars minimum
    $table->string('email')->change(); // min 255
});
```

### 1.8 SQL Injection Prevention

✅ **Actuellement sûr** (utilisation d'Eloquent/prepared statements)

À **JAMAIS FAIRE**:
```php
// ❌ DANGER - Pas de requêtes raw avec variables
User::whereRaw("email = '$email'"); // DANGER!

// ✅ À faire:
User::where('email', $email); // Utiliser Eloquent
User::whereRaw('email = ?', [$email]); // Ou paramètres liés
```

### 1.9 XSS Protection

✅ **Actuellement protégé** (Blade échappe par défaut)

À **vérifier** partout:
```blade
<!-- ✅ Automatiquement échappé (sûr) -->
{{ $user->name }}

<!-- ❌ DANGER - À NE PAS UTILISER sauf pour contenu de confiance -->
{{!! $user->bio !!}} <!-- N'utiliser que si vraiment nécessaire -->

<!-- ✅ À faire: utiliser des filtres -->
{{ Str::limit($user->bio, 200) }}
```

---

## 2. 📊 SCALABILITÉ

### 2.1 Base de Données - Indexes

**Migration à ajouter**:
```php
// database/migrations/2026_04_17_add_database_indexes.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('email'); // Pour login optimisé
            $table->index('is_admin'); // Pour filtrage admin
            $table->index('created_at'); // Pour statistiques
        });

        // Profiles table
        Schema::table('profiles', function (Blueprint $table) {
            $table->index('user_id'); // Foreign key index
            $table->index('created_at');
        });

        // Experiences table
        Schema::table('experiences', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('created_at');
            $table->index(['user_id', 'created_at']); // Index composé pour tri
        });

        // Educations table
        Schema::table('educations', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('created_at');
        });

        // Skills table
        Schema::table('skills', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('level'); // Pour filtrage par niveau
        });

        // Hobbies table
        Schema::table('hobbies', function (Blueprint $table) {
            $table->index('user_id');
        });

        // CV Settings
        Schema::table('cv_settings', function (Blueprint $table) {
            $table->index('user_id')->unique(); // Chaque user = 1 seule config CV
        });

        // Cache table (pour sessions/cache)
        // Déjà optimisée, mais ajouter index si custom:
        Schema::table('cache', function (Blueprint $table) {
            $table->index('expiration');
        });
    }

    public function down(): void
    {
        // Drops...
    }
};
```

**Exécuter**:
```bash
php artisan migrate
```

### 2.2 Eager Loading (N+1 Problem)

**À appliquer** dans tous les contrôleurs:

```php
// ❌ MAUVAIS - N+1 queries
public function index()
{
    $users = User::all(); // 1 query
    
    foreach ($users as $user) {
        echo $user->profile->title; // N queries supplémentaires!
    }
}

// ✅ BON - Eager loading
public function dashboard()
{
    $user = auth()->user()->load([
        'profile',      // 1 query supplémentaire
        'experiences',  // 1 query supplémentaire
        'educations',   // 1 query supplémentaire
        'skills',       // 1 query supplémentaire
        'hobbies',      // 1 query supplémentaire
        'cvSetting'     // 1 query supplémentaire
    ]); // Total: 7 queries au lieu de 100+
    
    return view('dashboard', compact('user'));
}
```

### 2.3 Pagination

**À ajouter** dans les listes:

```php
// app/Http/Controllers/ExperienceController.php
public function index()
{
    $experiences = auth()->user()
        ->experiences()
        ->orderByDesc('created_at')
        ->paginate(10); // 10 par page
    
    return view('experiences.index', compact('experiences'));
}

// Dans la blade:
<div class="experiences-list">
    @foreach($experiences as $exp)
        <!-- Card -->
    @endforeach
</div>

<!-- Pagination links -->
{{ $experiences->links('pagination::tailwind') }}
```

### 2.4 Caching Stratégie

```php
// config/cache.php - Utiliser Redis en production
return [
    'default' => env('CACHE_DRIVER', 'database'),
    
    'stores' => [
        'database' => [ /* ... */ ],
        'redis' => [ /* Ajouter en production */ ],
    ]
];

// Utilisation dans les contrôleurs:
use Illuminate\Support\Facades\Cache;

public function index()
{
    // Cache Dashboard data
    $stats = Cache::remember('user_' . auth()->id() . '_stats', 3600, function() {
        return [
            'experiences_count' => auth()->user()->experiences()->count(),
            'educations_count' => auth()->user()->educations()->count(),
            'skills_count' => auth()->user()->skills()->count(),
        ];
    });
    
    return view('dashboard', compact('stats'));
}

// Invalider le cache après modifications:
public function store(Request $request)
{
    $experience = auth()->user()->experiences()->create($validated);
    
    // Vider le cache utilisateur
    Cache::forget('user_' . auth()->id() . '_stats');
    
    return redirect()->back()->with('success', 'Ajouté');
}
```

### 2.5 Queue Jobs (pour tâches lourdes)

```bash
php artisan make:job GenerateCvPdf
```

```php
// app/Jobs/GenerateCvPdf.php
<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Browsershot\Browsershot;

class GenerateCvPdf implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    public function __construct(public User $user)
    {}

    public function handle(): void
    {
        // Génération du PDF en arrière-plan
        Browsershot::url(route('dashboard.cv.preview', scheme: 'https'))
            ->margins(10, 10, 10, 10)
            ->format('A4')
            ->pdf(storage_path("app/cv_{$this->user->id}.pdf"));

        // Notifier l'utilisateur
        // $this->user->notify(new CvGeneratedNotification());
    }
}

// Utilisation:
public function download(Request $request)
{
    dispatch(new GenerateCvPdf(auth()->user()));
    
    return response()->json(['message' => 'Génération en cours...']);
}
```

### 2.6 Rate Limiting

```php
// app/Http/Middleware/RateLimitCustom.php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;

class RateLimitCustom
{
    public function __construct(protected RateLimiter $limiter) {}

    public function handle(Request $request, Closure $next)
    {
        $key = 'user_' . auth()->id() . '_' . $request->path();
        $maxAttempts = 60; // 60 requests
        $decaySeconds = 60; // par minute
        
        if ($this->limiter->tooManyAttempts($key, $maxAttempts, $decaySeconds)) {
            return response()->json(['error' => 'Too many requests'], 429);
        }

        $this->limiter->hit($key, $decaySeconds);
        
        return $next($request);
    }
}

// Appliquer dans routes/web.php:
Route::middleware(['auth', RateLimitCustom::class])->group(function() {
    // Routes API sensibles
});
```

### 2.7 Database Connection Pooling

```php
// config/database.php
'mysql' => [
    'driver' => 'mysql',
    'url' => env('DB_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => true,
    'engine' => null,
    
    // ✅ Ajouter pour connection pooling (production):
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
        PDO::ATTR_PERSISTENT => false, // Important!
    ]) : [],
],
```

### 2.8 Monitoring & Logging

```php
// config/logging.php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['daily', 'sentry'], // Ajouter Sentry en prod
    ],
    'daily' => [
        'driver' => 'daily',
        'path' => storage_path('logs/laravel.log'),
        'level' => env('LOG_LEVEL', 'debug'),
        'days' => 14, // Garder 14 jours de logs
    ],
],

// Utilisation dans les contrôleurs:
use Illuminate\Support\Facades\Log;

public function store(Request $request)
{
    try {
        $experience = auth()->user()->experiences()->create($validated);
        Log::info('Experience created', ['user_id' => auth()->id()]);
    } catch (Exception $e) {
        Log::error('Failed to create experience', [
            'user_id' => auth()->id(),
            'error' => $e->getMessage()
        ]);
    }
}
```

---

## 3. 🚀 RECOMMENDATIONS DE DÉPLOIEMENT

### 3.1 Avant le Déploiement en Production

```bash
# 1. Vérifier APP_DEBUG=false dans .env
APP_DEBUG=false

# 2. Générer une clé unique si pas déjà fait
php artisan key:generate

# 3. Optimiser l'autoloader
php artisan optimize

# 4. Cache les configurations
php artisan config:cache

# 5. Cache les routes
php artisan route:cache

# 6. Cache les vues
php artisan view:cache

# 7. Migrer la BD en production
php artisan migrate --force

# 8. Seed les données admin
php artisan db:seed --class=AdminUserSeeder
```

### 3.2 Utiliser HTTPS en Production

```php
// app/Providers/AppServiceProvider.php
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
```

### 3.3 Environment Variables Critiques

```env
# Production .env
APP_ENV=production
APP_DEBUG=false
APP_NAME="Sama CV"

# Database
DB_CONNECTION=mysql
DB_HOST=secure-db-host
DB_DATABASE=sama_cv_prod
DB_USERNAME=db_user
DB_PASSWORD=strong_random_password

# Cache & Sessions
CACHE_DRIVER=redis
SESSION_DRIVER=database
SESSION_LIFETIME=30

# Admin
ADMIN_EMAIL=admin@same-domain.com
ADMIN_PASSWORD=bcrypt(strong_password)

# Mail (optionnel)
MAIL_MAILER=smtp
MAIL_HOST=smtp.provider.com
MAIL_FROM_ADDRESS=noreply@same-domain.com

# Autres
APP_URL=https://sama-cv.com
TRUSTED_PROXIES=*
```

### 3.4 Sauvegardes Automatiques

```bash
# Ajouter dans crontab:
0 2 * * * /usr/bin/mysqldump -u root -ppassword sama_cv | gzip > /backups/sama_cv_$(date +\%Y\%m\%d).sql.gz

# Nettoyer les anciens backups
0 3 * * * find /backups -name "*.sql.gz" -mtime +30 -delete
```

---

## 4. ✅ CHECKLIST DE SÉCURITÉ

- [ ] APP_DEBUG=false
- [ ] APP_KEY généré
- [ ] HTTPS activé
- [ ] Headers de sécurité implémentés
- [ ] CSRF tokens dans tous les formulaires
- [ ] Validation stricte des champs
- [ ] Sanitization des uploads
- [ ] Rate limiting actif
- [ ] Logs monitoriés
- [ ] Database indexes optimisés
- [ ] Eager loading utilisé partout
- [ ] Passwords hachés (bcrypt)
- [ ] Sessions sécurisées
- [ ] Pas de données sensibles en logs
- [ ] Backups automatiques

---

## 5. 📈 CHECKLIST DE SCALABILITÉ

- [x] Caching implémenté (Filament widgets)
- [ ] Redis configuré pour sessions/cache
- [ ] Queue jobs pour tâches lourdes (PDF)
- [ ] Database indexes optimisés
- [ ] Eager loading partout (no N+1)
- [ ] Pagination sur listes longues
- [ ] CDN pour assets statiques
- [ ] Monitoring en place
- [ ] Logs rotatifs (14 jours)
- [ ] Connection pooling configuré

