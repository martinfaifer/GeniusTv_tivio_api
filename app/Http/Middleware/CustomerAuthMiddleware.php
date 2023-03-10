<?php

namespace App\Http\Middleware;

use App\Models\Sessions;
use Closure;
use Illuminate\Http\Request;

class CustomerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Sessions::where('payload', 'like', '%'.$request->mac.','.$request->identity)->first()) {
            return abort(401);
        }

        return $next;
    }
}
