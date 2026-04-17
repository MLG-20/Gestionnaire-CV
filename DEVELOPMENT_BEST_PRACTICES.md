# 🛡️ BONNES PRATIQUES DE DÉVELOPPEMENT - Sama CV

## 1. 🔐 SÉCURITÉ

### Contrôleurs - Template Validé

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class YourController extends Controller
{
    /**
     * Validation stricte
     */
    public function store(Request $request)
    {
        // 1. Valider
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'email' => 'required|email:rfc,dns',
            'color' => 'hex_color',
        ]);

        // 2. Autoriser
        $this->authorize('create', Model::class); // Use policies!

        // 3. Créer (mass assignment protégé)
        $model = auth()->user()->models()->create($validated);

        // 4. Logger
        Log::info('Model created', ['id' => $model->id, 'user_id' => auth()->id()]);

        return redirect()->back()->with('success', 'Créé');
    }

    /**
     * Pas de requêtes raw non paramétrées
     */
    public function search(Request $request)
    {
        $search = $request->input('q'); // Ne jamais utiliser directement!

        // ✅ BON
        $results = Model::where('title', 'like', '%' . $search . '%')->get();
        
        // ❌ MAUVAIS - NE PAS FAIRE
        // $results = DB::select("SELECT * FROM models WHERE title LIKE '%$search%'");
    }
}
```

### Modèles - Configuration Sécurisée

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YourModel extends Model
{
    // 1. Mass assignment protection
    protected $fillable = ['title', 'description', 'email'];
    
    // ❌ NE JAMAIS UTILISER
    // protected $guarded = [];

    // 2. Casts (sécurité + types)
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // 3. Chiffrement pour données sensibles
    // protected $casts = [
    //     'email' => 'encrypted',
    //     'phone' => 'encrypted',
    // ];

    // 4. Appends (attributs virtuels)
    protected $appends = ['formatted_title'];

    public function getFormattedTitleAttribute(): string
    {
        return ucfirst($this->title);
    }

    // 5. Scopes sécurisés
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOwnedBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
```

### Blade - XSS Prevention

```blade
<!-- ✅ SÛRE - Échappée par défaut -->
<h1>{{ $title }}</h1>

<!-- ✅ SÛRE - Helper estoupe -->
<p>{{ Str::limit($description, 100) }}</p>

<!-- ✅ SÛRE - Blade directives -->
@if($user->is_admin)
    <span>Admin</span>
@endif

<!-- ❌ DANGEREUSE - À ÉVITER -->
{!! $html !!} <!-- Utiliser que si vraiment sûr -->

<!-- ✅ ALTERNATIVE SÛRE -->
{!! Str::of($html)->trim() !!}

<!-- XSS protégé avec attributs -->
<img src="{{ asset('images/' . $image) }}" alt="{{ $alt }}">
```

---

## 2. 📊 PERFORMANCE

### Eager Loading (N+1 Prevention)

```php
// ❌ MAUVAIS - 11 queries
$users = User::all();
foreach ($users as $user) {
    echo $user->profile->title; // 10 queries supplémentaires
}

// ✅ BON - 2 queries
$users = User::with('profile')->get();
foreach ($users as $user) {
    echo $user->profile->title;
}

// ✅ BON - Chargement implicite
$user = auth()->user()->load('profile', 'experiences');

// ✅ BON - Chargement conditionnel
$users = User::with([
    'profile' => fn($q) => $q->where('active', true),
    'experiences' => fn($q) => $q->limit(5),
])->get();
```

### Pagination

```php
// ✅ BON
public function index()
{
    $items = auth()->user()->items()
        ->orderByDesc('created_at')
        ->paginate(15);
    
    return view('items.index', compact('items'));
}

// Dans Blade
{{ $items->links('pagination::tailwind') }}
{{ $items->appends(request()->query())->links() }} // Avec query params

// Pagination custom
$items->perPage(25);
```

### Caching

```php
use Illuminate\Support\Facades\Cache;

// Timeout: 1h = 3600s
$data = Cache::remember('key_' . auth()->id(), 3600, function() {
    // Récupérer données lourdes
    return auth()->user()->load('relationships')->toArray();
});

// Invalider après changement
Cache::forget('key_' . auth()->id());

// Cache avec condition
if (Cache::has('user_stats_' . auth()->id())) {
    $stats = Cache::get('user_stats_' . auth()->id());
} else {
    $stats = computeStats();
    Cache::put('user_stats_' . auth()->id(), $stats, 3600);
}
```

---

## 3. 📝 CODAGE

### Linting & Formatting

```bash
# Vérifier le code avant commit
php artisan lint

# Formatter auto
php artisan migrate
php artisan config:cache
```

### Naming Conventions

```php
// Classes - PascalCase
class UserController
class ProfileRepository
class SendEmailJob

// Méthodes/Fonctions - camelCase
public function getUserProfile()
public function sendNotification()

// Variables - camelCase
$userName = 'John';
$isAdmin = true;

// Constantes - UPPER_SNAKE_CASE
const MAX_LOGIN_ATTEMPTS = 5;
const DEFAULT_THEME = 'light';

// Routes - kebab-case
Route::get('/user-profile', [UserController::class, 'show']);
Route::post('/send-email', [EmailController::class, 'send']);
```

### Comments Standards

```php
/**
 * Description brève de la fonction
 *
 * Description détaillée si complexe.
 *
 * @param Request $request - Description du paramètre
 * @param int $id - Description
 * @return string - Description du retour
 * @throws Exception - Si erreur possible
 */
public function handle(Request $request, int $id): string
{
    // Comment si logique complexe
    $result = expensive_calculation();
    return $result;
}
```

---

## 4. 🧪 TESTING

### Principes

```php
// Ne tester que les features, pas les implémentations
class ProfileTest extends TestCase
{
    /** @test */
    public function user_can_update_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->put('/profile', [
                'title' => 'New Title'
            ]);

        $response->assertRedirect();
        $this->assertEquals('New Title', $user->fresh()->profile->title);
    }

    /** @test */
    public function non_authenticated_user_cannot_update_profile()
    {
        $response = $this->put('/profile', []);
        $response->assertRedirect('/login');
    }
}
```

---

## 5. 🚀 DÉPLOIEMENT

### Commandes Essentielles

```bash
# Avant chaque déploiement
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# En production (une seule fois)
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Database
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder

# Assets
npm run build
```

### Checklist Préproduction

- [ ] APP_DEBUG=false
- [ ] APP_ENV=production
- [ ] HTTPS activé
- [ ] Database backup
- [ ] Logs configurés
- [ ] Security headers testés
- [ ] Rate limiting testés
- [ ] Email configured
- [ ] Storage permissions ok
- [ ] Cache cleared

---

## 6. ❌ ERREURS À ÉVITER

```php
// ❌ NE PAS FAIRE

// 1. Mass assignment sans fillable
$user->update($request->all());

// 2. Requêtes raw avec variables
DB::select("SELECT * FROM users WHERE id = $id");

// 3. No validation
$user->update($request->input());

// 4. No authorization checks
public function delete($id) {
    User::find($id)->delete(); // Pas de vérification!
}

// 5. Hardcoded credentials
$password = 'my_secret_password';

// 6. No eager loading
foreach ($users as $user) {
    echo $user->profile->title; // N+1!
}

// 7. Blade output without escaping
{{ $user_input }} ✅ Safe
{!! $user_input !!} ❌ Unsafe

// 8. No cache invalidation
$user->update($data);
// Cache devient stale!

// 9. Overloaded methods
if ($request->is('admin/*')) { ... }
// Use middleware instead!

// 10. Global functions overuse
User::all(); // 1000+ users loaded!
// Use pagination!
```

---

## 7. ✅ PATTERNS À UTILISER

### Repository Pattern (optionnel mais clean)

```php
// app/Repositories/UserRepository.php
class UserRepository
{
    public function getActive()
    {
        return User::where('is_active', true)
            ->with('profile')
            ->paginate(15);
    }

    public function findWithRelations($id)
    {
        return User::with(['profile', 'experiences', 'skills'])
            ->findOrFail($id);
    }
}

// Usage in Controller
class UserController extends Controller
{
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('users', ['users' => $this->repo->getActive()]);
    }
}
```

### Service Pattern (Business Logic)

```php
// app/Services/CvGeneratorService.php
class CvGeneratorService
{
    public function generate(User $user): string
    {
        $data = $this->collectData($user);
        return view('pdf.cv', $data)->render();
    }

    private function collectData(User $user): array
    {
        return [
            'user' => $user,
            'experiences' => $user->experiences()->get(),
            'skills' => $user->skills()->get(),
        ];
    }
}

// Usage
$pdf = app(CvGeneratorService::class)->generate(auth()->user());
```

---

## 8. 📚 RESOURCES

- [Laravel Docs](https://laravel.com/docs)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Security](https://www.php.net/manual/en/security.php)
- [Database Security](https://www.postgresql.org/docs/current/sql-syntax.html)

---

## 9. 👥 TEAM PRACTICES

1. **Code Review AVANT merge**
2. **Tests obligatoires pour features**
3. **Commit messages clairs**: `fix: user validation` ou `feat: cv export`
4. **Branch naming**: `feature/user-profile` ou `bugfix/login-issue`
5. **Pull requests avec description**
6. **Pas de commits directement en main**
7. **Deploy en staging d'abord** (si possible)

---

**Version 1.0 - 17 Avril 2026**
Mettre à jour ce guide au fur et à mesure des bonnes pratiques découvertes!
