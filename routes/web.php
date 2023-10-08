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

Route::get('/register', [AuthController::class,'viewRegister']);
Route::post('/register', [AuthController::class,'register']);

Route::post('/login', [AuthController::class,'login']);
Route::get('/', [AuthController::class,'viewLogin'])->name('login');

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/pelanggan', [PelangganController::class, 'index'])->middleware(['auth']);
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->middleware(['auth']);
Route::post('/pelanggan/store', [PelangganController::class, 'store'])->middleware(['auth']);
Route::get('/pelanggan/edit/{id}', [PelangganController::class,'edit'])->middleware(['auth']);
Route::post('/pelanggan/update/{id}', [PelangganController::class,'update'])->middleware(['auth']);
Route::get('/pelanggan/destroy/{id}', [PelangganController::class,'destroy'])->middleware(['auth']);
Route::get('/pelanggan/export', [PelangganController::class,'exportExcel'])->middleware(['auth']);

Route::get('/pelanggan-{id}-detail-{tahun}', [PelangganController::class, 'detail'])->middleware(['auth']);
Route::get('/pelanggan-{id}-detail-{tahun}/tagihan/create', [PelangganController::class, 'createTagihan'])->middleware(['auth']);
Route::post('/pelanggan-{id}-detail-{tahun}/tagihan/store', [PelangganController::class, 'storeTagihan'])->middleware(['auth']);
Route::get('/pelanggan-{id}-detail-{tahun}/tagihan/edit/{tagihan}', [PelangganController::class, 'editTagihan'])->middleware(['auth']);
Route::post('/pelanggan-{id}-detail-{tahun}/tagihan/update/{tagihan}', [PelangganController::class, 'updateTagihan'])->middleware(['auth']);
Route::get('/pelanggan-{id}-detail-{tahun}/tagihan/destroy/{tagihan}', [PelangganController::class, 'destroyTagihan'])->middleware(['auth']);
Route::get('/pelanggan-{id}-detail-{tahun}/tagihan/export', [PelangganController::class, 'exportExcelTagihanPelanggan'])->middleware(['auth']);


// Route::get('/tagihan', [TagihanController::class, 'index']);
Route::get('/tagihan', [TagihanController::class, 'viewTahun'])->middleware(['auth']);
Route::get('/{id}-tagihan', [TagihanController::class, 'viewBulan'])->middleware(['auth']);
Route::get('/{id}-tagihan-{bulan}', [TagihanController::class, 'viewDataTagihan'])->middleware(['auth']);
Route::get('/{id}-tagihan-{bulan}/export', [TagihanController::class, 'exportExcel'])->middleware(['auth']);

Route::get('/tagihan/{id}/{bulan}/create', [TagihanController::class, 'create'])->middleware(['auth'])->name('data.tagihan');
Route::post('/tagihan/{id}/{bulan}/store', [TagihanController::class, 'store'])->middleware(['auth']);
Route::get('/tagihan/{id}/{bulan}/edit/{tagihan}', [TagihanController::class,'edit'])->middleware(['auth']);
Route::post('/tagihan/{id}/{bulan}/update/{tagihan}', [TagihanController::class,'update'])->middleware(['auth']);
Route::get('/tagihan/{id}/{bulan}/destroy/{tagihan}', [TagihanController::class,'destroy'])->middleware(['auth']);
