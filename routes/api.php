<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::post('/saldo/{username}', 'UserController@saldo');

Route::middleware(['jwt.verify'])->group(function(){
    Route::get('/trans/{id}', 'PengeluaranController@show');
    Route::get('trans', 'PengeluaranController@index');
    Route::put('/trans/{id}', 'PengeluaranController@edit');
    Route::delete('/trans/{id}', 'PengeluaranController@destroy');
    Route::post('trans', 'PengeluaranController@create');
});