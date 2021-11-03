<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\NoteController::class, 'index']);

    Route::get('note/create', [App\Http\Controllers\NoteController::class, 'create']);
    Route::post('note/create', [App\Http\Controllers\NoteController::class, 'store']);


    Route::get('note/edit/{accessKey}', [App\Http\Controllers\NoteController::class, 'edit']);
    Route::patch('note/edit/{accessKey}', [App\Http\Controllers\NoteController::class, 'update']);

    Route::get('note/view/{accessKey}', [App\Http\Controllers\NoteController::class, 'show']);

    Route::get('note/delete/{accessKey}', [App\Http\Controllers\NoteController::class, 'destroy']);



});

Route::get('shared-note/view/{accessKey}', [App\Http\Controllers\NoteController::class, 'show']);



Auth::routes();
