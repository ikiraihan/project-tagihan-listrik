<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TagihanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::get('/pelanggan/create', [PelangganController::class, 'create']);
Route::post('/pelanggan/store', [PelangganController::class, 'store']);
Route::get('/pelanggan/edit/{id}', [PelangganController::class,'edit']);
Route::post('/pelanggan/update/{id}', [PelangganController::class,'update']);
Route::get('/pelanggan/destroy/{id}', [PelangganController::class,'destroy']);

// Route::get('/tagihan', [TagihanController::class, 'index']);
Route::get('/tagihan', [TagihanController::class, 'viewTahun']);
Route::get('/tagihan/{id}', [TagihanController::class, 'viewBulan']);
Route::get('/tagihan/{id}/{bulan}', [TagihanController::class, 'viewDataTagihan']);
Route::get('/tagihan/create', [TagihanController::class, 'create']);
Route::post('/tagihan/store', [TagihanController::class, 'store']);
Route::get('/tagihan/edit/{id}', [TagihanController::class,'edit']);
Route::post('/tagihan/update/{id}', [TagihanController::class,'update']);
Route::get('/tagihan/destroy/{id}', [TagihanController::class,'destroy']);
