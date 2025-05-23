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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['namespace' => 'Post', 'middleware' => 'jwt.auth'], function () {
    Route::get('/posts', 'IndexController');
    Route::get('/posts/{post}', 'ShowController');

    Route::post('/posts', 'StoreController');
    Route::patch('/posts/{post}', 'UpdateController');
    Route::get('/posts/{post}/restore', 'RestoreController');
    Route::delete('/posts/{post}', 'DestroyController');
});

