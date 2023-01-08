<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            //
            'nama_brg'=>$row[0],
            'harga_brg'=>$row[1],
            'satuan'=>$row[2],
            'kota_brg'=>$row[3],
            'deskripsi'=>$row[4],
            'stok'=>$row[5],
            'terjual'=>$row[6],
            'foto'=>$row[7],
            'kategori_id'=>$row[8],
        ]);
    }
}
