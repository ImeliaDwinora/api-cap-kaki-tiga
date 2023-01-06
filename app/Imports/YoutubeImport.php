<?php

namespace App\Imports;

use App\Models\Youtube;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class YoutubeImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Youtube([
            'video_id'=>$row[0],
            'kategori_id'=>$row[1],
            //
        ]);
    }
    
       
    
}
