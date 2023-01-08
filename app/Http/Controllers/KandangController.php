<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class KandangController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $kandang = Kandang::where('user_id', '=', $id)->get();
        return $this->success(
            "Data Kandang",
            $kandang
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
        'jenis_kandang' => 'required|string',
        'nama_kandang' => 'required|string',
        'stok_pakan' => 'required|integer',
        'jantan' => 'required|integer',
        'betina' => 'required|integer',
        'foto' => 'required|string',
        'user_id' => 'required|integer',
        ]);
        Kandang::create($validated);
        return $this->success(
            "Berhasil tambah kandang",
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
            'stok_pakan' => 'integer',
            'jantan' => 'integer',
            'betina' => 'integer',
            ]);
            Kandang::find($id)->update($validated);
            return $this->success(
                "Berhasil update kandang",
            );
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
}
