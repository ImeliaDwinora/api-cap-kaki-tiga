<?php

namespace App\Http\Controllers;

use App\Http\Resources\PembelianResource;
use App\Models\Pembelian;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PembelianController extends Controller
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
            'data pembelian',
            PembelianResource::collection(Pembelian::all()),

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
            'total_brg' => 'required|integer',
            'user_id' => 'required|integer',
            'barang_id' => 'required|integer',
        

        ]);
        Pembelian::create($validated);
        return $this->success(
            'Berhasil Memasukkan Pembelian',
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
        $pembelian = Pembelian::find($id);
        if ($pembelian) {
            return $this->success(
                'Data Pembelian',
                new PembelianResource($pembelian),
            );
        } else {
            return $this->fail(
                'Pembelian Tidak Ditemukan',
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
            'total_brg' => 'integer',
            'user_id' => 'integer',
            'barang_id' => 'integer',

        ]);
        $pembelian = Pembelian::find($id);
        if ($pembelian) {
            $pembelian->update($validated);
            return $this->success(
                'Berhasil Mengupdate Pembelian',
                null,
            );
        } else {
            return $this->fail(
                'Pembelian Tidak Bisa Diupdate',
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
        $pembelian = Pembelian::find($id);
        if ($pembelian) {
            $pembelian->delete();
            return $this->success(
                'Berhasil Menghapus pembelian',
                null,
            );
        } else {
            return $this->fail(
                'pembelian Tidak Bisa Dihapus',
                null,
                404,
            );
        }
    }
}
