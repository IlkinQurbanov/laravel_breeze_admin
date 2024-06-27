<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->isAuthenticated($request)) {
            return redirect($this->redirectTo($request));
        }

        return $next($request);
    }

    /**
     * Determine if the user is authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function isAuthenticated(Request $request): bool
    {
        // This method should check if the user is authenticated.
        // You can implement this method based on your authentication logic.
        // For example:
        return auth()->check();
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
