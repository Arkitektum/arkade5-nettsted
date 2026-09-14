<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectLegacyDomain
{
    /**
     * Redirect a request arriving on a legacy host to the canonical host,
     * keeping the path and query string intact.
     *
     * Requests to the API are left alone. The Arkade desktop client is built
     * against a fixed host name, and most HTTP clients turn a redirected POST
     * into a GET without its body, which would break the download flow for
     * clients that are already installed.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $canonicalHost = config('domains.canonical_host');

        if (empty($canonicalHost)) {
            return $next($request);
        }

        if (! in_array($request->getHost(), config('domains.legacy_hosts'), true)) {
            return $next($request);
        }

        if ($request->is('api/*') || ! $request->isMethodSafe()) {
            return $next($request);
        }

        return redirect()->away(
            'https://'.$canonicalHost.$request->getRequestUri(),
            config('domains.redirect_status')
        );
    }
}
