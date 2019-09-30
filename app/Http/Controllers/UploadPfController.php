<?php

namespace sitoque\Http\Controllers;

use Illuminate\Http\Request;

class UploadPfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaFisica');
    }
}
