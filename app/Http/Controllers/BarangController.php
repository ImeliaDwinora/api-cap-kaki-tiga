<?php

namespace App\Http\Controllers;

use App\Http\Resources\BarangResource;
use App\Models\Barang;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->success(
            'data barang',
            BarangResource::collection(Barang::all()),

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama_brg' => 'required|string',
            'harga_brg' => 'required|integer',
            'satuan' => 'required|integer',
            'kota_brg' => 'required|string',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer',
            'kategori_id' => 'required|integer',

        ]);
        Barang::create($validated);
        return $this->success(
            'Berhasil Memasukkan Barang',
            null,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $barang = Barang::find($id);
        if ($barang) {
            return $this->success(
                'Data Barang',
                new BarangResource($barang),
            );
        } else {
            return $this->fail(
                'Barang Tidak Ditemukan',
                null,
                404,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'nama_brg' => 'string',
            'harga_brg' => 'integer',
            'satuan' => 'integer',
            'kota_brg' => 'string',
            'deskripsi' => 'string',
            'stok' => 'integer',
            'kategori_id' => 'integer',

        ]);
        $barang = Barang::find($id);
        if ($barang) {
            $barang->update($validated);
            return $this->success(
                'Berhasil Mengupdate Barang',
                null,
            );
        } else {
            return $this->fail(
                'Barang Tidak Bisa Diupdate',
                null,
                404,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $barang = Barang::find($id);
        if ($barang) {
            $barang->delete();
            return $this->success(
                'Berhasil Menghapus Barang',
                null,
            );
        } else {
            return $this->fail(
                'Barang Tidak Bisa Dihapus',
                null,
                404,
            );
        }
    }
}
