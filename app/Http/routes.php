<?php

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', function() {
        return view('pages/index');
    });

    Route::get('/home', 'HomeController@index');
});
