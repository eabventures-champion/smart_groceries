<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheHeaders
{
    /**
     * Add cache-control headers to responses to speed up repeat visits.
     * Static assets are already cached by the web server, but this handles
     * dynamic HTML pages and AJAX responses.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Don't cache if user is authenticated (admin pages, etc.)
        if ($request->is('admin/*') || $request->is('vendor/*')) {
            return $response;
        }

        // Don't cache POST/PUT/DELETE requests
        if (!$request->isMethod('GET')) {
            return $response;
        }

        // For AJAX requests (miniCart, wishlist, etc.) - short cache
        if ($request->ajax()) {
            $response->headers->set('Cache-Control', 'private, max-age=30');
            return $response;
        }

        // For regular page views - cache for 5 minutes with revalidation
        if ($response->getStatusCode() === 200) {
            $response->headers->set('Cache-Control', 'public, max-age=300, must-revalidate');
            $response->headers->set('Vary', 'Accept-Encoding');
        }

        return $response;
    }
}
