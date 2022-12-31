<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PembelianResource extends JsonResource
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
            'tgl_pembelian' => $this->tgl_pembelian,
            'total_brg' => $this->total_brg,
            'user_id' => $this->user_id,
            'barang' => new BarangResource($this->barangs),
        ];
    }
}
