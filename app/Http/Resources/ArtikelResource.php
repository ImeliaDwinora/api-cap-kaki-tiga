<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtikelResource extends JsonResource
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
        'judul' => $this->judul,
        'isi_artikel' => $this->isi_artikel,
        'foto' => $this->foto,
        'kategori' => $this->kategoris->nama_kategori,
       ];
    }
}
