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
        'middleware' => ['role:boss|admin']
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

        Route::get('/categories', 'CategoryController@index');
        Route::post('/categories', 'CategoryController@store');
        Route::post('/categories/update/{id}', 'CategoryController@update');
        Route::delete('/categories/{id}', 'CategoryController@destory');

        Route::get('/series', 'SeriesController@index');
        Route::post('/series', 'SeriesController@store');
        Route::post('/series/update/{id}', 'SeriesController@update');
        Route::delete('/series/{id}', 'SeriesController@destory');

        Route::get('/videos', 'VideoController@index');
        Route::post('/videos', 'VideoController@store');
        Route::put('/videos/{id}', 'VideoController@update');
        Route::delete('/videos/{id}', 'VideoController@restory');
    });
});

