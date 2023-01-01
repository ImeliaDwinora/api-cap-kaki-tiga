<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembelianController;
use App\Models\User;
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
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('artikel', ArtikelController::class);
    Route::apiResource('barang', BarangController::class);
    Route::get('barang/kategori/{kategori}', [BarangController::class, 'barangPerKategori']);
    Route::get('barang/tertinggi/{kategori}', [BarangController::class, 'indexTertinggi']);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('pembelian', PembelianController::class);
    Route::get('pembelian/user/{userId}', [PembelianController::class, 'pembelianUser']);
    Route::post('checkout', [CheckoutController::class, 'checkout']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user/current', [AuthController::class, 'show']);
});

Route::post('check', [AuthController::class, 'check']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('user', function(){
    return User::all();
});
Route::post('import', [ArtikelController::class, 'import']);
Route::post('barang/import', [ArtikelController::class, 'barangImport']);
Route::post('pembelian/import', [ArtikelController::class, 'pembelianImport']);

