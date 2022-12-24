<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AspirationController;
use App\Http\Controllers\Backend\DashboardController;
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

Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('/register', 'registration');
        Route::post('/login', 'authenticate');
        Route::post('/checkSession/{id}', 'checkSession');
    });
Route::prefix('dashboard')
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/{id}/makeAdmin', 'makeAdmin')->name('makeAdmin');
        Route::post('/{id}/changeStatus', 'changeStatus')->name('changeStatus');
        Route::post('/{id}/delete', 'destroy')->name('makeAdmin');
    });

// aspiration route grouping
Route::prefix('aspiration')
    ->controller(AspirationController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/dashboard/{id}', 'getAspiById')->name('aspi.id');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/create', 'store')->name('store');
        Route::post('/{id}/delete', 'destroy')->name('destroy');
    });
