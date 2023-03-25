<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Dotenv\Dotenv;
class CanInstall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Dotenv::createImmutable(base_path())->load();
        if (env('APP_INSTALLED', false) == false) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
