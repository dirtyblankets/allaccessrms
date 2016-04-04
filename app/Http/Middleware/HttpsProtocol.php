<?php namespace AllAccessRMS\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class HttpsProtocol {
	
    public function handle($request, Closure $next)
    {
            if (!$request->secure() && env('APP_ENV') === 'prod') {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request); 
    }
}