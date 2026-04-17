<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Prévenir le clickjacking (ne pas permettre d'embedding dans iframes)
        $response->header('X-Frame-Options', 'DENY');

        // Prévenir le MIME type sniffing
        $response->header('X-Content-Type-Options', 'nosniff');

        // Protection XSS (navigateur)
        $response->header('X-XSS-Protection', '1; mode=block');

        // Content Security Policy - Permissive for Filament
        $csp = "default-src 'self'; "
             . "script-src 'self' 'unsafe-inline' 'unsafe-eval'; "
             . "style-src 'self' 'unsafe-inline' fonts.bunny.net; "
             . "font-src fonts.bunny.net data:; "
             . "img-src 'self' data: https:; "
             . "connect-src 'self' https:; "
             . "frame-ancestors 'none'; "
             . "upgrade-insecure-requests;";
        $response->header('Content-Security-Policy', $csp);

        // Referrer Policy - Protection de la vie privée
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        // HSTS - Force HTTPS (31536000 = 1 an)
        if ($this->app()->environment('production')) {
            $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Permissions Policy - Désactiver les APIs dangereuses
        $permissions = "geolocation=(), "
                     . "microphone=(), "
                     . "camera=(), "
                     . "payment=(), "
                     . "usb=(), "
                     . "magnetometer=(), "
                     . "gyroscope=(), "
                     . "accelerometer=()";
        $response->header('Permissions-Policy', $permissions);

        return $response;
    }

    private function app()
    {
        return app();
    }
}
