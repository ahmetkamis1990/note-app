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


Route::post('/login', 'App\Http\Controllers\API\AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('notes', [\App\Http\Controllers\API\NoteApiController::class, 'list']);
    Route::post('notes', [\App\Http\Controllers\API\NoteApiController::class, 'store']);
    Route::get('notes/{accessKey}', [\App\Http\Controllers\API\NoteApiController::class, 'show']);
    Route::put('notes/{accessKey}', [\App\Http\Controllers\API\NoteApiController::class, 'update']);
    Route::delete('notes/{accessKey}', [\App\Http\Controllers\API\NoteApiController::class, 'destroy']);


});

