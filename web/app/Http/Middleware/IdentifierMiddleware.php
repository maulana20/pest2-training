<?php


namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use App\Services\IdentifierService;

class IdentifierMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        IdentifierService::identifierByPath($request);
        return $next($request);
    }
}
