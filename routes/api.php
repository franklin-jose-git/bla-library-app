<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\BorrowingController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function (){
    Route::post('/login',[ AuthController::class, 'login']);
    Route::post('/logout',[ AuthController::class, 'logout']);
    Route::get('/me',[ AuthController::class, 'userProfile']);
});

Route::group([
    'middleware' => 'auth:api',
], function (){
    Route::prefix('/books')->group(function () {
        Route::get('/',[ BookController::class, 'get']);
        Route::post('/',[ BookController::class, 'create']);
        Route::get('/{id}',[ BookController::class, 'getById']);
        Route::put('/{id}',[ BookController::class, 'update']);
        Route::delete('/{id}',[ BookController::class, 'delete']);
        Route::post('/search',[ BookController::class, 'search']);
    });

    Route::prefix('/borrowings')->group(function () {
        Route::get('/',[ BorrowingController::class, 'get']);
        Route::post('/',[ BorrowingController::class, 'create']);
        Route::get('/{id}',[ BorrowingController::class, 'getById']);
        Route::put('/{id}',[ BorrowingController::class, 'update']);
        Route::delete('/{id}',[ BorrowingController::class, 'delete']);
    });

    Route::prefix('/users')->group(function () {
        Route::get('/',[ UserController::class, 'get']);
        Route::post('/',[ UserController::class, 'create']);
        Route::get('/{id}',[ UserController::class, 'getById']);
        Route::put('/{id}',[ UserController::class, 'update']);
        Route::delete('/{id}',[ UserController::class, 'delete']);
    });

    Route::prefix('/dashboard')->group(function () {
        Route::get('/',[ DashboardController::class, 'dashboard']);
    });
});
