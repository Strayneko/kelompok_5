<?php

<<<<<<< HEAD
use App\Http\Controllers\Backend\AspirationController;
=======
>>>>>>> b9735374265be6daa02ec2638bac19a4b689e2ce
use App\Http\Controllers\Backend\AuthController;
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
Route::post('/register/a', [AuthController::class, 'registration']);
Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('/register', 'registration');
        Route::post('/login', 'authenticate');
    });
Route::prefix('dashboard')
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/', 'index');
    });

// aspiration route grouping
Route::prefix('aspiration')
    ->controller(AspirationController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::post('/create', 'store')->name('store');
        Route::delete('/{id}/delete', 'destroy')->name('destroy');
    });
