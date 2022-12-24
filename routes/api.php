<?php

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
