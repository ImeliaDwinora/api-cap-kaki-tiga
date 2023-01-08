<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembelianController;
use Illuminate\Support\Str;
use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\User;
use App\Models\Youtube;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('artikel', ArtikelController::class);
    Route::apiResource('barang', BarangController::class);
    Route::get('barang/kategori/{kategori}', [BarangController::class, 'barangPerKategori']);
    Route::get('barang/tertinggi/{kategori}', [BarangController::class, 'indexTertinggi']);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('pembelian', PembelianController::class);
    Route::get('pembelian/{kategori}/user/{userId}', [PembelianController::class, 'pembelianUser']);
    Route::post('checkout', [CheckoutController::class, 'checkout']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user/current', [AuthController::class, 'show']);
    Route::patch('user/current/edit/{id}', [AuthController::class, 'update']);
    Route::get('kandang/user/{id}', [KandangController::class, 'index']);
    Route::post('kandang', [KandangController::class, 'store']);
    Route::patch('kandang/{id}', [KandangController::class, 'update']);
    Route::get('youtube', function () {
        return [
            "status" => true,
            "message" => "video youtube",
            "data" => Youtube::all()
        ];
    });
});

Route::post('check', [AuthController::class, 'check']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('user', function () {
    return User::all();
});
Route::post('kategori/import', [ArtikelController::class, 'kategoriImport']);
Route::post('artikel/import', [ArtikelController::class, 'artikelImport']);
Route::post('barang/import', [ArtikelController::class, 'barangImport']);
Route::post('pembelian/import', [ArtikelController::class, 'pembelianImport']);
Route::post('youtube/import', [ArtikelController::class, 'YoutubeImport']);
Route::post('kandang/import', [ArtikelController::class, 'KandangImport']);


Route::post('tes', function (Request $request) {
    $obj = $request->pembelian;
    $jsonObject = json_decode($obj);
    foreach ($jsonObject as $value) {
        $userId = $value->user_id;
        $barangId = $value->barang_id;
        $jumlahBarang = $value->total_brg;
        $barang = Barang::find($barangId);
        $stok = $barang->stok;
        $terjual = $barang->terjual;
        if ($stok > $jumlahBarang) {
            // ubah stok & ubah penjualan
            $stok = $stok - $jumlahBarang;
            $terjual = $terjual + $jumlahBarang;
            $update = [
                'stok' => $stok,
                'terjual' => $terjual,
            ];
            $barang->update($update);
            // tambah record ke tabel pembelian
            $insert = [
                'tgl_pembelian' => date('Y-m-d'),
                'user_id' => $userId,
                'barang_id' => $barangId,
                'total_brg' => $jumlahBarang,
            ];
            Pembelian::create($insert);
        }
    }
    return [
        'message' => 'Berhasil tambah pembelian'
    ];
});
