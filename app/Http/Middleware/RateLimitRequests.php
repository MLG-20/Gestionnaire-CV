<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;
use Illuminate\Routing\Exceptions\ThrottleRequestsException;

class RateLimitRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 5, $decaySeconds = 60)
    {
        $key = $this->resolveRequestSignature($request);
        
        $limiter = app(RateLimiter::class);
        
        // Vérifier si trop de tentatives
        if ($limiter->tooManyAttempts($key, $maxAttempts, $decaySeconds)) {
            throw $this->buildException($request, $key, $maxAttempts, $limiter);
        }
        
        // Enregistrer la tentative
        $limiter->hit($key, $decaySeconds);
        
        $response = $next($request);
        
        // Ajouter les headers de rate limit
        return $this->addHttpHeaders(
            $response,
            $maxAttempts,
            $decaySeconds,
            $limiter,
            $key
        );
    }

    /**
     * Créer la clé uniquement pour ce request.
     */
    protected function resolveRequestSignature(Request $request): string
    {
        // Si utilisateur authentifié, utiliser son ID
        if ($request->user()) {
            return 'rate_limit_' . $request->user()->id . '_' . $request->path();
        }
        
        // Sinon utiliser l'IP
        return 'rate_limit_' . $request->ip() . '_' . $request->path();
    }

    /**
     * Créer l'exception pour trop de tentatives.
     */
    protected function buildException(Request $request, string $key, int $maxAttempts, RateLimiter $limiter)
    {
        $retryAfter = $limiter->availableIn($key);
        
        $response = response()->json([
            'message' => 'Trop de requêtes. Veuillez réessayer dans ' . $retryAfter . ' secondes.',
            'retry_after' => $retryAfter,
        ], 429);
        
        return new ThrottleRequestsException(
            limit: $maxAttempts,
            retryAfter: $retryAfter,
            response: $response
        );
    }

    /**
     * Ajouter les headers RateLimit au response.
     */
    protected function addHttpHeaders($response, int $maxAttempts, int $decaySeconds, RateLimiter $limiter, string $key)
    {
        $response->header('X-RateLimit-Limit', $maxAttempts)
                ->header('X-RateLimit-Remaining', max(0, $maxAttempts - $limiter->attempts($key)))
                ->header('X-RateLimit-Reset', now()->addSeconds($decaySeconds)->timestamp);
        
        return $response;
    }
}
