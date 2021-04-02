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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Product routes
Route::get('/auth/products', 'Api\\ProductController@index');

// User routes
Route::post('auth/login', 'Api\\AuthController@login');
Route::post('auth/register', 'Api\\AuthController@register');

// Middleware Routes
Route::group(['middleware' => 'apiJWT'], function(){
    //User routes
    Route::get('auth/users', 'Api\\UserController@index');
    Route::post('auth/logout', 'Api\\AuthController@logout');
    Route::delete('auth/destroy/{user}', 'Api\\AuthController@destroy');

    // Product routes
    Route::post('auth/products/register', 'Api\\ProductController@register');
    Route::put('auth/products/update/{product}', 'Api\\ProductController@update');
    Route::delete('auth/products/destroy/{product}', 'Api\\ProductController@destroy');
});




// Route::get('users', 'Api\\UserController@index');
// Route::get('users', 'Api\\UserController@index')->middleware('auth:api');


