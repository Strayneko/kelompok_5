<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\AuthViewController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\DashboardController;
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
    return redirect()->route('aspiration.create');
})->name('home');

// aspiration route grouping
Route::name('aspiration.')
    ->prefix('aspiration')
    ->middleware(['auth', 'checkrole:2'])
    ->controller(AspirationController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create')->withoutMiddleware(['checkrole:2'])->middleware(['checkrole:1']);
        Route::get('/dashboard/', 'getAspiByid')->name('getAspiByid')->withoutMiddleware(['checkrole:2'])->middleware(['checkrole:1']);
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/create', 'store')->name('store');
        Route::delete('/{id}/delete', 'destroy')->name('destroy');
    });

// auth route grouping
Route::name('auth.')
    ->prefix('auth')
    ->group(function () {
        Route::get('/', [AuthViewController::class, 'login'])->name('login')->middleware('withAuth');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('noAuth');
        Route::get('/register', [AuthViewController::class, 'register'])->name('register')->middleware('withAuth');
        Route::post('/', [AuthController::class, 'authenticate'])->name('authenticate');
        // Route::post('/register', 'registration')->name('registration');
    });

// dashboard
Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'checkrole:2'])
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });
