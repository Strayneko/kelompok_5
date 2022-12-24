<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return response()->json(['message' => 'server running in port 8000']);
});

// aspiration route grouping
Route::name('aspiration.')
    ->prefix('aspiration')
    ->controller(AspirationController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/create', 'store')->name('store');
        Route::delete('/{id}/delete', 'destroy')->name('destroy');
    });

// auth route grouping
Route::name('auth.')
    ->prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::post('/', 'authenticate')->name('authenticate');
        Route::post('/register', 'registration')->name('registration');
    });
