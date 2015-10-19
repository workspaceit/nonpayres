<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controller('login', 'LoginController');

Route::group(['prefix' => 'app'], function () {
    /* User Route Start */
    Route::any('register/user', 'UserController@register');
    /* User Route End */
});