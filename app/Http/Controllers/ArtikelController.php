<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtikelResource;
use App\Imports\ArtikelImport;
use App\Imports\BarangImport;
use App\Imports\ExcelImport;
use App\Imports\PembelianImport;
use App\Models\Artikel;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArtikelController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = $request->query('limit');

        if($query) {
            return $this->success(
                'data artikel',
                ArtikelResource::collection(Artikel::inRandomOrder()->limit($query)->get()),
            );
        }
        else {
            return $this->success(
                'data artikel',
                ArtikelResource::collection(Artikel::all()),
            );
        }
        

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
        $artikel= Artikel::find($id);
        if($artikel){
            return $this->success(
                'Data Artikel',
                new ArtikelResource($artikel),
            );
        }else{
            return $this->fail(
                'Artikel Tidak Ditemukan',
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
    }

    public function import(Request $request){
        $file=$request->file;
        Excel::import(new ExcelImport, $file);
        return ['Message'=>'kategori dan artikel Berhasil di Import'];
    }

    public function barangImport(Request $request){
        $file=$request->file;
        Excel::import(new BarangImport, $file);
        return ['Message'=>'barang Berhasil di Import'];
    }

    public function pembelianImport(Request $request){
        $file=$request->file;
        Excel::import(new PembelianImport, $file);
        return ['Message'=>'pembelian Berhasil di Import'];
    }
}
