<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){
    // Authentication Routes...
    Route::get('login', 'PessoaFisicaAuth\LoginController@showLoginForm')->name('pessoaFisica.formLogin');
    Route::post('login', 'PessoaFisicaAuth\LoginController@login')->name('pessoaFisica.login');
    Route::post('logout', 'PessoaFisicaAuth\LoginController@logout');

    // Registration Routes...
    Route::get('register', 'PessoaFisicaAuth\RegisterController@showRegistrationForm');
    Route::post('register', 'PessoaFisicaAuth\RegisterController@register')->name('pessoaFisica.register');

    // Password Reset Routes...
    Route::get('password/reset', 'PessoaFisicaAuth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'PessoaFisicaAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'PessoaFisicaAuth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'PessoaFisicaAuth\ResetPasswordController@reset');
});

Route::group(['prefix' => 'PessoaJuridica', 'middleware' => 'pessoaJuridica'], function(){
    // Authentication Routes...
    Route::get('login', 'PessoaJuridicaAuth\LoginController@showLoginForm')->name('pessoaJuridica.formLogin');
    Route::post('login', 'PessoaJuridicaAuth\LoginController@login')->name('pessoaJuridica.login');
    Route::post('logout', 'PessoaJuridicaAuth\LoginController@logout');

    // Registration Routes...
    Route::get('register', 'PessoaJuridicaAuth\RegisterController@showRegistrationForm');
    Route::post('register', 'PessoaJuridicaAuth\RegisterController@register')->name('pessoaJuridica.register');

    // Password Reset Routes...
    Route::get('password/reset', 'PessoaJuridicaAuth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'PessoaJuridicaAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'PessoaJuridicaAuth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'PessoaJuridicaAuth\ResetPasswordController@reset');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
