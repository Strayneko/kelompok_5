<?php

use App\Http\Controllers\AspirationController;
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

// aspiration route grouping
Route::name('aspiration.')
    ->prefix('aspiration')
    ->controller(AspirationController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::get('/{id}/edit', 'edit');
        Route::post('/{id}/update', 'update');
        Route::post('/create', 'store');
        Route::delete('/{id}/delete', 'destroy');
    });

// auth route grouping
Route::name('auth.')
    ->prefix('auth')
    ->controller(AspirationController::class)
    ->group(function () {
        Route::get('/', 'login');
        Route::get('/register', 'register');
        Route::post('/', 'authenticate');
        Route::post('/register', 'registration');
    });
