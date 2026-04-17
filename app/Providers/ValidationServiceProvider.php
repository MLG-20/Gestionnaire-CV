<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Validateur personnalisé pour les couleurs hexadécimales
        Validator::extend('hex_color', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^#[0-9A-Fa-f]{6}$/', $value) === 1;
        }, 'Le champ :attribute doit être une couleur hexadécimale valide (ex: #FF00AA)');

        // Validateur pour les slugs (alphanumériques, tirets, underscores)
        Validator::extend('slug', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-z0-9_-]+$/', $value) === 1;
        }, 'Le champ :attribute doit contenir uniquement des lettres minuscules, chiffres, tirets et underscores');

        // Validateur pour les noms (lettres, accents, espaces, tirets, apostrophes) - STRICTER
        Validator::extend('name', function ($attribute, $value, $parameters, $validator) {
            // Must be 2-255 chars, only letters/accents/spaces/hyphens/apostrophes
            // Reject SQL/HTML characters
            return strlen($value) >= 2 && strlen($value) <= 255
                && preg_match('/^[a-zA-ZÀ-ÿ\s\-\']+$/', $value) === 1
                && !preg_match('/[;"<>()[\]{}\\\\]/', $value);
        }, 'Le champ :attribute contient des caractères non autorisés ou est trop court');

        // Validateur pour les téléphones
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\d\s\-\+\.()]{10,20}$/', $value) === 1;
        }, 'Le champ :attribute doit être un numéro de téléphone valide');

        // Validateur pour URLs sûres
        Validator::extend('safe_url', function ($attribute, $value, $parameters, $validator) {
            $url = filter_var($value, FILTER_VALIDATE_URL);
            if (!$url) {
                return false;
            }
            
            // Vérifier que c'est http ou https
            $parsed = parse_url($url);
            return isset($parsed['scheme']) && in_array($parsed['scheme'], ['http', 'https']);
        }, 'Le champ :attribute doit être une URL valide');
    }
}
