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

    Route::get('/', ['as' => 'home', 'uses' => 'PageController@index']);
});


Route::group(['middleware' => 'web'], function () {
    $config = [
        'as' => 'admin.',
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => ['role:admin|boss']
    ];

    Route::group($config, function() {

        Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

        Route::get('/dashboard/information', 'InfoController@dashboard');

        Route::get('/fetchAuth', 'InfoController@auth');
        Route::get('/users', 'UserController@activeUsers');
        Route::get('/users/notActive', 'UserController@notActiveUsers');
        Route::get('/users/trashed', 'UserController@trashedUsers');
        Route::put('/users/restore', 'UserController@restoreUser');
        Route::put('/users/toggleActive', 'UserController@toggleUserActive');
        Route::DELETE('/users/remove', 'UserController@removeToTrash');
        Route::DELETE('/users/delete', 'UserController@deleteUser');

        Route::get('/series', 'SeriesController@index');
        Route::post('/series', 'SeriesController@store');
    });
});

