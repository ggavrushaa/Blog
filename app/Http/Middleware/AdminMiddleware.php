<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
       $user = $request->user();
       if($user->admin === false) {
            abort(403);
       }

       return $next($request);
    }

    protected function isAdmin(Request $request)
    {
        return false;
    }
}
