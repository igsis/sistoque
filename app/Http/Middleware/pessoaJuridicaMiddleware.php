<?php

namespace sitoque\Http\Middleware;

use Closure;

class pessoaJuridicaMiddleware
{
    protected $guard = 'pessoaJuridica';

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function unauthenticated($request, AuthnticationException $exception)
    {
        if($request->expectsJson())
        {
            return response()->json(['error' => 'unauthenticated'], 401);
        }

        $guard = array_get($exception->guards(), 0);
        switch($guard)
        {
            case 'pessoaFisica':
                $login = 'pessoaFisica.formLogin';
                break;
            case 'pessoaJuridica':
                $login = 'pessoaJuridica.formLogin';
                break;
            default:
                $login = 'login';
        }
        return redirect()->guest(route($login));
    }
}
