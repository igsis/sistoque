<?php

namespace App\Http\Middleware;

use Closure;

class nivelAcesso
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nivel = auth()->user()->nivelAcesso->id;

        session(['nv' => $nivel]);

        return $next($request);
    }
}
