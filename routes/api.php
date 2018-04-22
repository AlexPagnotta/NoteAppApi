<?php

use Illuminate\Http\Request;
use App\Note;

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

Route::post('user/register', 'APIRegisterController@register');
Route::post('user/login', 'APILoginController@login');

Route::get('notes', 'NotesController@index');
Route::get('notes/{id}', 'NotesController@show');
Route::post('notes', 'NotesController@store');
Route::put('notes/{id}', 'NotesController@update');
Route::delete('notes/{id}', 'NotesController@destroy');


