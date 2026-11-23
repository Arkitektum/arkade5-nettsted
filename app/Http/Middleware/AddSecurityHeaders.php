<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

class AddSecurityHeaders
{
    /**
     * Content security policy for the static front page in public/frontend.
     *
     * The page loads Leaflet from unpkg, fonts from Google, map tiles from
     * Kartverket, and calls the GitHub and Brønnøysund APIs from the browser.
     */
    private const FRONT_PAGE_POLICY = [
        'script-src' => ["'self'", 'https://unpkg.com'],
        'style-src' => ["'self'", 'https://fonts.googleapis.com', 'https://unpkg.com'],
        'font-src' => ["'self'", 'https://fonts.gstatic.com'],
        'img-src' => ["'self'", 'data:', 'https://cache.kartverket.no', 'https://unpkg.com'],
        'connect-src' => ["'self'", 'https://api.github.com', 'https://data.brreg.no'],
    ];

    /**
     * Content security policy for everything rendered by Laravel, i.e. the
     * admin pages and the auth pages, which load fonts from Bunny Fonts.
     */
    private const APPLICATION_POLICY = [
        'script-src' => ["'self'", "'unsafe-eval'"],
        'style-src' => ["'self'", "'unsafe-inline'", 'https://fonts.bunny.net'],
        'font-src' => ["'self'", 'https://fonts.bunny.net'],
        'img-src' => ["'self'", 'data:'],
        'connect-src' => ["'self'"],
    ];

    /**
     * Directives shared by both policies.
     */
    private const COMMON_POLICY = [
        'default-src' => ["'self'"],
        'object-src' => ["'none'"],
        'base-uri' => ["'self'"],
        'form-action' => ["'self'"],
        'frame-ancestors' => ["'none'"],
    ];

    /**
     * Browser features the site has no use for.
     */
    private const DISABLED_FEATURES = [
        'accelerometer',
        'camera',
        'geolocation',
        'gyroscope',
        'magnetometer',
        'microphone',
        'payment',
        'usb',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', $this->permissionsPolicy());

        // The Vite dev server serves assets from another origin and over a
        // websocket, which the policies do not allow for.
        if (! Vite::isRunningHot()) {
            $response->headers->set('Content-Security-Policy', $this->contentSecurityPolicy($request));
        }

        return $response;
    }

    private function contentSecurityPolicy(Request $request): string
    {
        $policy = $request->is('/') ? self::FRONT_PAGE_POLICY : self::APPLICATION_POLICY;

        // Cloudflare injects a script into every HTML page and gives it the
        // nonce it finds in this header.
        $policy['script-src'][] = "'nonce-".base64_encode(random_bytes(16))."'";

        return collect(self::COMMON_POLICY)
            ->merge($policy)
            ->map(fn (array $sources, string $directive) => $directive.' '.implode(' ', $sources))
            ->implode('; ');
    }

    private function permissionsPolicy(): string
    {
        return collect(self::DISABLED_FEATURES)
            ->map(fn (string $feature) => $feature.'=()')
            ->implode(', ');
    }
}
