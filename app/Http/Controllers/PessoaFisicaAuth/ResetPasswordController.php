<?php

namespace sitoque\Http\Controllers\PessoaFisicaAuth;

use sitoque\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/PessoaFisica/home';


    public function __construct()
    {
        $this->middleware('guest:pessoaFisica');
    }
}
