<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param string $permitted
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $permitted): Response
    {
        if (auth()->user()->role != $permitted) {
            abort(401);
        }

        return $next($request);
    }
}
