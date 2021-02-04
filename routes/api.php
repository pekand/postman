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

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => ['apitoken']], function()
{
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/user', [App\Http\Controllers\AuthController::class, 'user']);

    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'list']);
    Route::get('/project/{id}', [App\Http\Controllers\ProjectController::class, 'view']);
    Route::post('/project', [App\Http\Controllers\ProjectController::class, 'insert']);
    Route::put('/project/{id}', [App\Http\Controllers\ProjectController::class, 'update']);
    Route::delete('/project/{id}', [App\Http\Controllers\ProjectController::class, 'delete']);

    Route::get('/requests/{id}', [App\Http\Controllers\RequestController::class, 'list']);
    Route::get('/request/{id}', [App\Http\Controllers\RequestController::class, 'view']);
    Route::post('/request', [App\Http\Controllers\RequestController::class, 'insert']);
    Route::put('/request/{id}', [App\Http\Controllers\RequestController::class, 'update']);
    Route::delete('/request/{id}', [App\Http\Controllers\RequestController::class, 'delete']);

    Route::get('/calls/{id}', [App\Http\Controllers\CallController::class, 'list']);
    Route::get('/call/{id}', [App\Http\Controllers\CallController::class, 'view']);
    Route::post('/call', [App\Http\Controllers\CallController::class, 'insert']);
    Route::put('/call/{id}', [App\Http\Controllers\CallController::class, 'update']);
    Route::delete('/call/{id}', [App\Http\Controllers\CallController::class, 'delete']);

});
