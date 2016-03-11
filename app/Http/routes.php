<?php

Carbon\Carbon::setLocale('zh');

Route::get('/test', function() {
    // return VideoApi::setType('youku')->getVideoDetail('XMTQ0MzU4MDMwOA==');
    // return VideoApi::setType('vimeo')->getVideoDetail('146522326');
    // return VideoApi::setType('youtube')->getVideoDetail('8ItNE_DX6Cc');
});

Route::group(['middleware' => 'web'], function () {

    /************************************
    * Home Page.
    ************************************/
    Route::get('/', [
        'as' => 'home',
        'uses' => 'PageController@index']
    );

    /************************************
    * Github
    ************************************/
    Route::get('/auth/github', [
        'as' => 'auth.github.login',
        'uses' => 'Auth\SocialController@redirectToGithub'
    ]);
    Route::get('/auth/github/callback', [
        'as' => 'auth.github.login.callback',
        'uses' => 'Auth\SocialController@handleGithubOAuth'
    ]);

    /************************************
    * Twitter
    ************************************/
    Route::get('/auth/twitter', [
        'as' => 'auth.twitter.login',
        'uses' => 'Auth\SocialController@redirectToTwitter'
    ]);
    Route::get('/auth/twitter/callback', [
        'as' => 'auth.twitter.login.callback',
        'uses' => 'Auth\SocialController@handleTwitterOAuth'
    ]);

    /************************************
    * Auth
    ************************************/
    Route::controller('auth', 'Auth\AuthController', [
        'getRegister'  => 'auth.register',
        'postRegister' => 'auth.register.post',
        'getLogin'     => 'auth.login',
        'postLogin'    => 'auth.login.post',
        'getLogout'    => 'auth.logout',
    ]);

    /************************************
    * Password
    ************************************/
    Route::controller('password', 'Auth\PasswordController');

    /************************************
    * Series
    ************************************/
    Route::get('/series', [
        'as' => 'series',
        'uses' => 'SeriesController@index']
    );
    Route::get('/series/{slug}', [
        'as' => 'series.show',
        'uses' => 'SeriesController@show']
    );
    Route::get('/series/{slug}/episodes/{vid}', [
        'as' => 'series.video.show',
        'uses' => 'SeriesController@showVideo']
    );

    /************************************
    * Videos
    ************************************/
    Route::get('/videos', [
        'as' => 'videos',
        'uses' => 'VideoController@index']
    );

    /************************************
    * Categories
    ************************************/
    Route::get('/categories/{name}', [
        'as' => 'categories',
        'uses' => 'CategoryController@show']
    );

    /************************************
    * Blogs
    ************************************/
    Route::get('/blogs', [
        'as' => 'blogs',
        'uses' => 'BlogController@index']
    );
    Route::get('/blogs/{id}', [
        'as' => 'blogs.show',
        'uses' => 'BlogController@show']
    );

    /************************************
    * Newsletters
    ************************************/
    Route::get('/newsletters', [
        'as' => 'newsletters',
        'uses' => 'NewsletterController@index']
    );
    Route::get('/newsletters/{id}', [
        'as' => 'newsletters.show',
        'uses' => 'NewsletterController@show']
    );
    Route::post('/newsletters/subscribe', [
        'as' => 'subscribe',
        'uses' => 'NewsletterController@subscribe']
    );
    Route::post('/newsletters/unsubscribe', [
        'as' => 'unsubscribe',
        'uses' => 'NewsletterController@unsubscribe']
    );

    /************************************
    * User
    ************************************/
    Route::get('/user/profile', [
        'as' => 'user.profile',
        'uses' => 'UserController@index']
    );
    Route::post('/user/profile', [
        'as' => 'user.profile.update',
        'uses' => 'UserController@updateProfile']
    );
    Route::get('/user/account', [
        'as' => 'user.account',
        'uses' => 'UserController@account']
    );
    Route::post('/user/account', [
        'as' => 'user.account.update',
        'uses' => 'UserController@updateAccount']
    );
});


/************************************
* Admin
************************************/
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
        Route::put('/users/restore/{id}', 'UserController@restoreUser');
        Route::put('/users/toggleActive/{id}', 'UserController@toggleUserActive');
        Route::DELETE('/users/remove/{id}', 'UserController@removeToTrash');
        Route::DELETE('/users/delete/{id}', 'UserController@deleteUser');

        Route::get('/roles', 'RoleController@index');
        Route::post('/roles/user/{id}', 'RoleController@assign');

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
        Route::delete('/videos/{id}', 'VideoController@destory');

        Route::get('/blogs', 'BlogController@index');
        Route::post('/blogs', 'BlogController@store');
        Route::get('/blogs/{id}', 'BlogController@edit');
        Route::put('/blogs/{id}', 'BlogController@update');
        Route::delete('/blogs/{id}', 'BlogController@destory');
        Route::put('/blogs/togglePublished/{id}', 'BlogController@togglePublished');
        Route::put('/blogs/toggleTop/{id}', 'BlogController@toggleTop');

        Route::get('/subscribers', 'SubscriberController@index');
        Route::delete('/subscribers/{email}', 'SubscriberController@destory');

        Route::get('/newsletters', 'NewsletterController@index');
        Route::post('/newsletters', 'NewsletterController@store');
        Route::post('/newsletters/publish/{id}', 'NewsletterController@publish');
        Route::delete('/newsletters/{id}', 'NewsletterController@destory');

        Route::get('/links', 'LinkController@index');
        Route::post('/links', 'LinkController@store');
        Route::put('/links/{id}', 'LinkController@update');
        Route::delete('/links/{id}', 'LinkController@destory');
    });
});
