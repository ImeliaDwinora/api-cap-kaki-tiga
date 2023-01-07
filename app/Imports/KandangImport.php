<?php

namespace App\Imports;

use App\Models\Kandang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class KandangImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Kandang([
            'jenis_kandang'=>$row[0],
            'nama_kandang'=>$row[1],
            'stok_pakan'=>$row[2],
            'jantan'=>$row[3],
            'betina'=>$row[4],
            'foto'=>$row[5],
            'user_id'=>$row[6],
        ]);
   
        
    }
}
