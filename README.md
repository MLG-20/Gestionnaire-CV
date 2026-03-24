# CVForge — Gestionnaire de CV Laravel 12

Application complète de création et gestion de CV professionnels, avec 20 templates, génération PDF et page vitrine premium.

---

## Sommaire

- [Présentation](#présentation)
- [Stack technique](#stack-technique)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Structure de la base de données](#structure-de-la-base-de-données)
- [Architecture du projet](#architecture-du-projet)
- [Modèles Eloquent](#modèles-eloquent)
- [Contrôleurs](#contrôleurs)
- [Routes](#routes)
- [Vues et layouts](#vues-et-layouts)
- [Templates CV](#templates-cv)
- [Génération PDF](#génération-pdf)
- [Gestion de la photo de profil](#gestion-de-la-photo-de-profil)
- [Personnalisation des couleurs](#personnalisation-des-couleurs)
- [Landing page](#landing-page)
- [Commandes utiles](#commandes-utiles)

---

## Présentation

CVForge permet à chaque utilisateur de :

1. **Saisir ses données** — coordonnées, résumé professionnel, photo de profil
2. **Gérer ses expériences** — postes, entreprises, dates, descriptions
3. **Gérer ses formations** — diplômes, établissements, années
4. **Gérer ses compétences** — avec 4 niveaux (Débutant → Expert) et barres de progression
5. **Gérer ses loisirs / centres d'intérêt**
6. **Choisir un template** parmi 20 designs (10 classiques + 10 tech/IT)
7. **Personnaliser les couleurs** via un color picker avec palettes prédéfinies
8. **Prévisualiser le CV** en navigateur
9. **Télécharger le PDF** en un clic (format A4 portrait)

---

## Stack technique

| Composant | Version |
| --- | --- |
| PHP | ^8.2 |
| Laravel | ^12.0 |
| Laravel Breeze (Blade) | ^2.3 |
| Tailwind CSS | v4 (via Vite) |
| Alpine.js | v3 (via Breeze) |
| barryvdh/laravel-dompdf | ^3.1 |
| intervention/image-laravel | ^1.5 |
| SQLite | — |

---

## Prérequis

- PHP 8.2+
- Composer
- Node.js 18+ / npm
- Extension PHP : `gd` ou `imagick` (pour Intervention Image)
- Extension PHP : `dom`, `mbstring`, `zip` (pour DomPDF)

---

## Installation

```bash
# 1. Cloner le dépôt
git clone <repo-url> Gestion-CV
cd Gestion-CV

# 2. Installer les dépendances PHP
composer install

# 3. Copier et configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Créer la base de données SQLite
touch database/database.sqlite

# 5. Lancer les migrations
php artisan migrate

# 6. Créer le lien symbolique pour le stockage des photos
php artisan storage:link

# 7. Installer les dépendances front-end et compiler
npm install
npm run build

# 8. Démarrer le serveur
php artisan serve
```

> **Avec Laravel Herd** : pointer le site vers le dossier `Gestion-CV`, le serveur démarre automatiquement.

### Démarrage tout-en-un (dev)

```bash
composer run dev
```

Lance en parallèle : serveur PHP, queue worker, Pail (logs) et Vite (HMR).

---

## Structure de la base de données

### Table `users` (étendue)

| Colonne | Type | Description |
| --- | --- | --- |
| id | bigint | PK |
| name | string | Nom complet |
| email | string | Email unique |
| photo_path | string\|null | Chemin relatif WebP dans `storage/app/public/` |
| password | string | Hash bcrypt |

### Table `profiles`

| Colonne | Type | Description |
| --- | --- | --- |
| user_id | bigint (FK, unique) | Relation 1-1 avec users |
| phone | string\|null | Téléphone |
| address | string\|null | Adresse / ville |
| linkedin_url | string\|null | URL LinkedIn |
| github_url | string\|null | URL GitHub |
| website_url | string\|null | Site personnel |
| professional_summary | text\|null | Résumé professionnel |

### Table `experiences`

| Colonne | Type | Description |
| --- | --- | --- |
| user_id | bigint (FK) | |
| job_title | string | Intitulé du poste |
| company | string | Nom de l'entreprise |
| location | string\|null | Lieu |
| start_date | date | Date de début |
| end_date | date\|null | Date de fin |
| is_current | boolean | Poste actuel ? |
| description | text\|null | Description / missions |
| sort_order | integer | Ordre d'affichage |

### Table `educations`

| Colonne | Type | Description |
| --- | --- | --- |
| user_id | bigint (FK) | |
| degree | string | Diplôme / titre |
| school | string | Établissement |
| field_of_study | string\|null | Domaine d'études |
| graduation_year | smallint unsigned\|null | Année d'obtention |
| description | text\|null | Description |
| sort_order | integer | Ordre d'affichage |

### Table `skills`

| Colonne | Type | Description |
| --- | --- | --- |
| user_id | bigint (FK) | |
| name | string | Nom de la compétence |
| level | string | `debutant` / `intermediaire` / `avance` / `expert` |
| sort_order | integer | Ordre d'affichage |

### Table `hobbies`

| Colonne | Type | Description |
| --- | --- | --- |
| user_id | bigint (FK) | |
| name | string | Nom du loisir |
| sort_order | integer | Ordre d'affichage |

### Table `cv_settings`

| Colonne | Type | Description |
| --- | --- | --- |
| user_id | bigint (FK, unique) | Relation 1-1 avec users |
| template_name | string | Slug du template (défaut : `classic`) |
| primary_color | string | Couleur principale hex (défaut : `#2563eb`) |
| secondary_color | string | Couleur secondaire hex (défaut : `#64748b`) |

> La table `cv_settings` est créée automatiquement lors de l'inscription via `User::booted()`.

---

## Architecture du projet

```text
app/
├── Http/
│   └── Controllers/
│       ├── DashboardController.php     # Page d'accueil dashboard
│       ├── ProfileController.php       # Profil + photo de profil
│       ├── ExperienceController.php    # CRUD expériences
│       ├── EducationController.php     # CRUD formations
│       ├── SkillController.php         # CRUD compétences
│       ├── HobbyController.php         # CRUD loisirs
│       ├── CvSettingController.php     # Choix template + couleurs
│       └── CvController.php            # Prévisualisation + PDF
└── Models/
    ├── User.php                        # + photo_url accessor + relations
    ├── Profile.php
    ├── Experience.php                  # + date_range accessor
    ├── Education.php
    ├── Skill.php                       # + level_label + level_percentage accessors
    ├── Hobby.php
    └── CvSetting.php                   # + availableTemplates() statique

database/
└── migrations/
    ├── 2026_03_09_152329_add_photo_path_to_users_table.php
    ├── 2026_03_09_152330_create_profiles_table.php
    ├── 2026_03_09_152331_create_experiences_table.php
    ├── 2026_03_09_152332_create_educations_table.php
    ├── 2026_03_09_152333_create_skills_table.php
    ├── 2026_03_09_152333_create_hobbies_table.php
    └── 2026_03_09_152334_create_cv_settings_table.php

resources/views/
├── home.blade.php                      # Landing page (standalone)
├── layouts/
│   ├── app.blade.php                   # Layout sidebar dashboard
│   └── cv.blade.php                    # Layout bare pour templates CV
├── dashboard/index.blade.php           # Page d'accueil avec étapes
├── profile/edit.blade.php              # Formulaire profil + photo
├── experiences/{index,create,edit,_form}.blade.php
├── educations/{index,create,edit,_form}.blade.php
├── skills/index.blade.php              # Ajout/suppression inline
├── hobbies/index.blade.php             # UI tags
├── cv-settings/edit.blade.php          # Sélecteur template + couleurs
└── templates/                          # 20 templates CV
    ├── classic.blade.php
    ├── modern.blade.php
    ├── minimalist.blade.php
    ├── creative.blade.php
    ├── executive.blade.php
    ├── elegant.blade.php
    ├── bold.blade.php
    ├── clean.blade.php
    ├── sidebar.blade.php
    ├── infographic.blade.php
    ├── terminal.blade.php
    ├── github.blade.php
    ├── devcard.blade.php
    ├── neon.blade.php
    ├── blueprint.blade.php
    ├── gradient.blade.php
    ├── matrix.blade.php
    ├── dashboard.blade.php
    ├── stack.blade.php
    └── data.blade.php
```

---

## Modèles Eloquent

### `User`

```php
// Relations
$user->profile        // hasOne Profile
$user->experiences    // hasMany Experience (ordonné par sort_order)
$user->educations     // hasMany Education (ordonné par sort_order)
$user->skills         // hasMany Skill (ordonné par sort_order)
$user->hobbies        // hasMany Hobby (ordonné par sort_order)
$user->cvSetting      // hasOne CvSetting

// Accesseur
$user->photo_url      // URL publique ou fallback UI Avatars
```

### `Experience`

```php
$exp->date_range      // "Jan 2022 - Présent" ou "Jan 2022 - Déc 2023"
```

### `Skill`

```php
$skill->level_label       // "Débutant" / "Intermédiaire" / "Avancé" / "Expert"
$skill->level_percentage  // 25 / 50 / 75 / 100
```

### `CvSetting`

```php
CvSetting::availableTemplates()  // Retourne les 20 templates avec slug, name, style, category
```

---

## Contrôleurs

### `ProfileController`

| Méthode | Route | Description |
| --- | --- | --- |
| `edit()` | GET /dashboard/profile/edit | Formulaire profil |
| `update()` | PUT /dashboard/profile | Sauvegarde nom, email, profil complet |
| `updatePhoto()` | POST /dashboard/profile/photo | Upload + resize 400×400 WebP |
| `destroyPhoto()` | DELETE /dashboard/profile/photo | Suppression photo |

### `CvController`

| Méthode | Route | Description |
| --- | --- | --- |
| `preview()` | GET /dashboard/cv/preview | Rendu Blade dans le navigateur |
| `download()` | GET /dashboard/cv/download | Génère et télécharge le PDF A4 |

---

## Routes

```text
GET  /                              → home (landing page)
GET  /dashboard                     → dashboard.index
GET  /dashboard/profile/edit        → dashboard.profile.edit
PUT  /dashboard/profile             → dashboard.profile.update
POST /dashboard/profile/photo       → dashboard.profile.photo.update
DEL  /dashboard/profile/photo       → dashboard.profile.photo.destroy

# Ressources CRUD (sans 'show')
/dashboard/experiences/{id?}        → dashboard.experiences.*
/dashboard/educations/{id?}         → dashboard.educations.*
/dashboard/skills/{id?}             → dashboard.skills.*  (sans create/edit)
/dashboard/hobbies/{id?}            → dashboard.hobbies.* (sans create/edit)

GET  /dashboard/cv-settings         → dashboard.cv-settings.edit
PUT  /dashboard/cv-settings         → dashboard.cv-settings.update
GET  /dashboard/cv/preview          → dashboard.cv.preview
GET  /dashboard/cv/download         → dashboard.cv.download
```

Toutes les routes `/dashboard/*` nécessitent l'authentification (`middleware(['auth'])`).

---

## Vues et layouts

### `layouts/app.blade.php`

Layout principal avec sidebar fixe. Contient :

- Navigation par section (Profil, Expériences, Formations, Compétences, Loisirs, Template)
- Bouton "Télécharger PDF" dans la sidebar
- Avatar utilisateur via `$user->photo_url`
- Pattern `@extends` / `@yield('content')`

### `layouts/cv.blade.php`

Layout minimal pour les templates CV (utilisé par DomPDF et la prévisualisation) :

- Injecte les variables CSS `--cv-primary` et `--cv-secondary` depuis `$cvSetting`
- Supporte `@push('styles')` pour les styles propres à chaque template

### `dashboard/index.blade.php`

Tableau de bord avec indicateur de complétion en 6 étapes :

1. Profil de base
2. Photo de profil
3. Expérience professionnelle
4. Formation
5. Compétences
6. Template & couleurs

---

## Templates CV

### Catégorie Classiques (10)

| Slug | Nom | Style |
| --- | --- | --- |
| `classic` | Classique | Header bleu, deux colonnes 60/40 |
| `modern` | Moderne | Sidebar colorée gauche, fond blanc |
| `minimalist` | Minimaliste | Une colonne, typographie seule |
| `creative` | Créatif | Bande accent en header, layout splitté |
| `executive` | Executive | Header foncé, bande contacts |
| `elegant` | Élégant | Nom centré, ornement, niveaux à points |
| `bold` | Bold | Grand header dégradé, préfixes `//` |
| `clean` | Clean | Fond gris clair, cartes arrondies |
| `sidebar` | Sidebar | Sidebar foncée, zone principale blanche |
| `infographic` | Infographie | Photo circulaire, timeline à points |

### Catégorie Tech / IT (10)

| Slug | Nom | Style | Couleur dominante |
| --- | --- | --- | --- |
| `terminal` | Terminal | Fenêtre CLI, monospace, prompt `$` | Vert `#22c55e` sur `#0d1117` |
| `github` | GitHub Profile | Layout profil GitHub | Bleu `#58a6ff` sur `#161b22` |
| `devcard` | Dev Card | Badge-style, hero indigo | Indigo `#6366f1` sur `#13111c` |
| `neon` | Neon | Effets néon, glows | Magenta `#e879f9` sur `#06060f` |
| `blueprint` | Blueprint | Grille technique, sections numérotées | Bleu `#60a5fa` sur `#0c1a2e` |
| `gradient` | Gradient | Hero dégradé, cartes glassmorphism | Sky→Indigo→Purple sur `#0f0f1a` |
| `matrix` | Matrix | Noir pur, vert `#00ff41`, coins `┌─┐` | Vert Matrix sur `#000` |
| `dashboard` | Dashboard | KPI cards, barres métriques | Multi-couleurs sur `#111827` |
| `stack` | Tech Stack | Catppuccin Mocha, tags stack, points | Bleu `#89b4fa` sur `#1e1e2e` |
| `data` | Data Analyst | Métriques header, barres par niveau | Cyan `#38bdf8` sur `#0f172a` |

### Variables disponibles dans les templates

Tous les templates reçoivent :

```php
$user        // User avec toutes les relations chargées
$cvSetting   // CvSetting (template_name, primary_color, secondary_color)
$forPdf      // bool — true lors de la génération PDF
```

> **Important** : Tous les templates utilisent `display:table` / `display:table-cell` pour les mises en page multi-colonnes. DomPDF ne supporte pas flexbox ni CSS grid.

---

## Génération PDF

Powered by **barryvdh/laravel-dompdf ^3.1**.

```php
// CvController@download
$pdf = Pdf::loadView("templates.{$template}", compact('user', 'cvSetting', 'forPdf'))
    ->setPaper('a4', 'portrait');

return $pdf->download("CV-{$user->name}.pdf");
```

Configuration DomPDF (`config/dompdf.php`) :

- `chroot` : chemin public du projet
- `isRemoteEnabled` : `true` (pour charger la photo depuis le storage)
- `defaultMediaType` : `print`

---

## Gestion de la photo de profil

Upload via `ProfileController@updatePhoto` :

```php
// Intervention Image v3 API
$image = Image::read($request->file('photo'))
    ->cover(400, 400)
    ->toWebp(quality: 85);

Storage::disk('public')->put("photos/{$user->id}.webp", $image);
```

- Format de sortie : **WebP** (qualité 85)
- Dimensions : **400×400 px** (recadrage centré)
- Stockage : `storage/app/public/photos/{user_id}.webp`
- URL publique : via `storage:link` → `public/storage/photos/{user_id}.webp`
- Fallback : [UI Avatars](https://ui-avatars.com) si pas de photo uploadée

---

## Personnalisation des couleurs

L'interface `cv-settings/edit.blade.php` (Alpine.js) propose :

- **Color picker** natif `<input type="color">` synchonisé avec un champ texte hex
- **10 palettes prédéfinies** (ex. : Bleu Classique, Violet Créatif, Rouge Bold, etc.)
- Les couleurs sont injectées dans `layouts/cv.blade.php` :

```html
<style>
    :root {
        --cv-primary: {{ $cvSetting->primary_color }};
        --cv-secondary: {{ $cvSetting->secondary_color }};
    }
</style>
```

Les templates classiques utilisent `var(--cv-primary)` et `var(--cv-secondary)`.
Les templates tech ont leur propre palette dark et ignorent ces variables.

---

## Landing page

`resources/views/home.blade.php` — page vitrine standalone (pas de `@extends`).

Sections :

1. **Navbar fixe** — glassmorphism, lien vers login/register
2. **Hero** — fond radial gradient, badge animé, mockup CV, CTA
3. **Stats** — 20 templates, 10 styles Tech, PDF 1 clic, ∞ personnalisation
4. **Fonctionnalités** — 6 cartes (templates, couleurs, PDF, compétences, hobbies, responsive)
5. **Galerie templates** — aperçu visuel des 20 templates
6. **Comment ça marche** — timeline 3 étapes
7. **Section tech** — bloc terminal avec exemple de code
8. **CTA** — appel à l'action avec effet glow
9. **Footer** — liens et copyright

Animations : scroll-reveal via `IntersectionObserver` sur les éléments `.reveal`.

---

## Commandes utiles

```bash
# Migrations
php artisan migrate
php artisan migrate:fresh          # Recrée toutes les tables

# Cache
php artisan config:cache
php artisan view:cache
php artisan route:cache

# Lien de stockage (obligatoire pour les photos)
php artisan storage:link

# Listing des routes
php artisan route:list --name=dashboard

# Tests
php artisan test

# Linter PHP
./vendor/bin/pint

# Build front-end
npm run build                      # Production
npm run dev                        # Développement (HMR)
```

---

## Licence

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).
