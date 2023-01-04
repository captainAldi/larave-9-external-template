<?php

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Prefix untuk /master
Route::prefix('master')->group(function () {

    // Buku
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/buku', [App\Http\Controllers\BukuController::class, 'index'])->name('get.buku');
        Route::get('/buku/tambah', [App\Http\Controllers\BukuController::class, 'tambah'])->name('get.tambah.buku');
        Route::post('/buku/tambah/proses', [App\Http\Controllers\BukuController::class, 'proses_tambah'])->name('post.proses-tambah.buku');
        Route::get('/buku/detail/{id}', [App\Http\Controllers\BukuController::class, 'detail'])->name('get.detail.buku');
        Route::get('/buku/ubah/{id}', [App\Http\Controllers\BukuController::class, 'ubah'])->name('get.ubah.buku');
        Route::patch('/buku/ubah/proses/{id}', [App\Http\Controllers\BukuController::class, 'proses_ubah'])->name('post.proses-ubah.buku');
        Route::delete('/buku/hapus/{id}', [App\Http\Controllers\BukuController::class, 'hapus'])->name('delete.buku');
    });


    // Penerbit
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/penerbit', [App\Http\Controllers\PenerbitController::class, 'index'])->name('get.penerbit');
        Route::get('/penerbit/tambah', [App\Http\Controllers\PenerbitController::class, 'tambah'])->name('get.tambah.penerbit');
        Route::post('/penerbit/tambah/proses', [App\Http\Controllers\PenerbitController::class, 'proses_tambah'])->name('post.proses-tambah.penerbit');
        Route::get('/penerbit/detail/{id}', [App\Http\Controllers\PenerbitController::class, 'detail'])->name('get.detail.penerbit');
        Route::get('/penerbit/ubah/{id}', [App\Http\Controllers\PenerbitController::class, 'ubah'])->name('get.ubah.penerbit');
        Route::patch('/penerbit/ubah/proses/{id}', [App\Http\Controllers\PenerbitController::class, 'proses_ubah'])->name('post.proses-ubah.penerbit');
        Route::delete('/penerbit/hapus/{id}', [App\Http\Controllers\PenerbitController::class, 'hapus'])->name('delete.penerbit');
    });


});

// No Prefix and Middleware Auth & Verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

    // Profile
    Route::get('/my-profile/{id}', [App\Http\Controllers\ProfileController::class, 'create'])->name('profile.home');
    Route::patch('/my-profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Get Files
    Route::get('/files/profile-picture/{namaFile}', [App\Http\Controllers\FilesController::class, 'showProfilePicture']);
});


