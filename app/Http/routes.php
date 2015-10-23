<?php

Route::any('', 'UserController@currentUser');

Route::group(['prefix' => 'app'], function () {
    Route::post('register/user', 'UserController@register');
    Route::any('logout', 'LoginController@getLogout');
    Route::post('login/authenticate', 'LoginController@postLogin');
    Route::post('login/authenticate/accesstoken', 'LoginController@postTokenLogin');
    Route::post('client/create', 'ClientController@newClient');
    Route::any('advice', 'AdviceController@getAdvices');
    Route::any('search/client', 'ClientController@search');
});