<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('V1')->prefix('v1/admin')->group(function (){
    // Auth routes
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@getUser');

    // Admin Users routes
    Route::prefix('users')->group(function (){
        Route::post('create', 'UserController@create');
        Route::put('{user}/update', 'UserController@update');
        Route::get('/all', 'UserController@index');
    });

    // Books routes
    Route::prefix('books')->group(function (){
        Route::get('all', 'BookController@index');
        Route::post('create', 'BookController@create');
        Route::put('{book}/update', 'BookController@update');
    });

    // Authors routes
    Route::prefix('authors')->group(function (){
        Route::get('all', 'AuthorController@index');
        Route::post('create', 'AuthorController@create');
        Route::put('{author}/update', 'AuthorController@update');
    });
});

Route::namespace('V1')->prefix('v1/customers')->group(function (){
    // Customers routes
    Route::post('login', 'CustomerController@login');
    Route::post('register', 'CustomerController@register');
    Route::get('logout', 'CustomerController@logout');
    Route::get('{customer}', 'CustomerController@getCustomerInfo');
});
