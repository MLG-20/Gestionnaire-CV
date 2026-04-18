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

        // On vérifie spécifiquement si c'est une instance de réponse HTTP classique (HTML/JSON)
        // Cela exclut automatiquement les BinaryFileResponse et les StreamedResponse
        if ($response instanceof \Illuminate\Http\Response || $response instanceof \Illuminate\Http\JsonResponse) {
            
            $response->headers->set('X-Frame-Options', 'DENY');
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-XSS-Protection', '1; mode=block');

            // CSP
            if (app()->environment('local')) {
                // En développement : très permissif pour Vite HMR
                $csp = "default-src *; "
                     . "script-src * 'unsafe-inline' 'unsafe-eval'; "
                     . "style-src * 'unsafe-inline'; "
                     . "img-src * data: blob:; "
                     . "font-src *; "
                     . "connect-src *; "
                     . "frame-ancestors 'none'; "
                     . "upgrade-insecure-requests;";
            } else {
                // En production : strict
                $csp = "default-src 'self'; "
                     . "script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; "
                     . "style-src 'self' 'unsafe-inline' https:; "
                     . "font-src https: data:; "
                     . "img-src 'self' data: https:; "
                     . "connect-src 'self' https:; "
                     . "frame-ancestors 'none'; "
                     . "upgrade-insecure-requests;";
            }
            $response->headers->set('Content-Security-Policy', $csp);

            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

            // HSTS
            if (app()->environment('production')) {
                $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
            }

            // Permissions
            $permissions = "geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), gyroscope=(), accelerometer=()";
            $response->headers->set('Permissions-Policy', $permissions);
        }

        return $response;
    }

    private function app()
    {
        return app();
    }
}
