<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_brg',
        'user_id',
        'barang_id',
        'tgl_pembelian',
    ];
    public function barangs()
    {
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }
    public $timestamps = false;
}
