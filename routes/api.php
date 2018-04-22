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

Route::get('notes', 'NotesController@index');
Route::get('notes/{note}', 'NotesController@show');
Route::post('notes', 'NotesController@store');
Route::put('notes/{note}', 'NotesController@update');
Route::delete('notes/{note}', 'NotesController@destroy');
