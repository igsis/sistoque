<?php

namespace sitoque\Http\Controllers\PessoaFisicaAuth;

use sitoque\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('auth:pessoaFisica');
    }
}
