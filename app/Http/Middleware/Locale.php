<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get data in Session, if null return default
        $language = \Session::get('website_language', config('app.locale'));
        
        // Transfer the app to the selected language
        config(['app.locale' => $language]);

        return $next($request);
    }
}
