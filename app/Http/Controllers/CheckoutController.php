<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class CheckoutController extends Controller
{
    //
    use ApiResponse;
    public function checkout(Request $request)
    {
        //variable yang dibutuhkan
        // user id, barang id, 
        $userId = $request->user_id;
        $barangId = $request->barang_id;
        $jumlahBarang = $request->jumlah_barang;
        // cek stok barang
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
            return $this->success(
                'Pembelian berhasil',
                null,
            );
        }
        else {
            return $this->fail(
                'Gagal checkout stok tidak cukup',
                null,
                200,
            );
        }
        
        return [
            'stok' => $stok,
            'terjual' => $terjual,
        ];
    }
}
