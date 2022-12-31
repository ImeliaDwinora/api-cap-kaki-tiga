<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nama_brg' => $this->nama_brg,
            'harga_brg' => $this->harga_brg,
            'satuan' => $this->satuan,
            'kota_brg' => $this->kota_brg,
            'deskripsi' => $this->deskripsi,
            'stok' => $this->stok,
            'terjual' => $this->terjual,
            'kategori_id' => $this->kategori_id, 
        ];
    }
}
