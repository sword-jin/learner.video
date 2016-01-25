<?php

Route::group(['middleware' => 'web'], function () {

    Route::controller('auth', 'Auth\AuthController', [
        'getRegister'  => 'auth.register',
        'postRegister' => 'auth.register.post',
        'getLogin'     => 'auth.login',
        'postLogin'    => 'auth.login.post',
        'getLogout'    => 'auth.logout',
    ]);

    Route::controller('password', 'Auth\PasswordController');

    Route::get('/', function() {
        return view('pages/index');
    });

    Route::group(['as' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {

        Route::get('/', 'HomeController@index');

    });
});

