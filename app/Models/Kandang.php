<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_kandang',
        'nama_kandang',
        'stok_pakan',
        'jantan',
        'betina',
        'foto',
       
    ];
}
