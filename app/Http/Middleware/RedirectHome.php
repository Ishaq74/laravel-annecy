<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectHome
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('/')) {
            $negotiator = new \Mcamara\LaravelLocalization\LanguageNegotiator(
                app('laravellocalization')->getDefaultLocale(),
                app('laravellocalization')->getSupportedLocales(),
                $request
            );
            $locale = $negotiator->negotiateLanguage();

            return redirect('/'.$locale.'/', 302);
        }

        return $next($request);
    }
}
