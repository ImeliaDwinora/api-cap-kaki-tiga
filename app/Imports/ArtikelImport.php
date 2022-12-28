<?php

namespace App\Imports;

use App\Models\Artikel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArtikelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Artikel([
            'judul'=>$row['judul'],
            'isi_artikel'=>$row['isi_artikel'],
            //
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }
}
