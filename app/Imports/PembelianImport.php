<?php

namespace App\Imports;

use App\Models\Pembelian;
use Maatwebsite\Excel\Concerns\ToModel;

class PembelianImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pembelian([
            
            //
            'tgl_pembelian'=>$row[0],
            'barang_id'=>$row[1],
            'total_brg'=>$row[2],
            'user_id'=>$row[3],
        ]);
    }
}
