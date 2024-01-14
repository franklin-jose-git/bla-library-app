<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\BorrowingController;

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

Route::prefix('/books')->group(function () {
    Route::get('/',[ BookController::class, 'get']);
    Route::post('/',[ BookController::class, 'create']);
    Route::get('/{id}',[ BookController::class, 'getById']);
    Route::put('/{id}',[ BookController::class, 'update']);
    Route::delete('/{id}',[ BookController::class, 'delete']);
});

Route::prefix('/borrowings')->group(function () {
    Route::get('/',[ BorrowingController::class, 'get']);
    Route::post('/',[ BorrowingController::class, 'create']);
    Route::get('/{id}',[ BorrowingController::class, 'getById']);
    Route::put('/{id}',[ BorrowingController::class, 'update']);
    Route::delete('/{id}',[ BorrowingController::class, 'delete']);
});
