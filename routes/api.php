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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);

//  Logout
Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:sanctum');

// Prefix Master
Route::prefix('master')->group(function () {

    // Middleware Auth Sanctum
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/buku', [App\Http\Controllers\API\BukuController::class, 'index']);
        Route::post('/buku/tambah', [App\Http\Controllers\API\BukuController::class, 'tambah']);
        Route::patch('/buku/ubah/{id}', [App\Http\Controllers\API\BukuController::class, 'ubah']);
        Route::delete('/buku/hapus/{id}', [App\Http\Controllers\API\BukuController::class, 'hapus']);

    });

});