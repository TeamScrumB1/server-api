<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
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
            'id' => $this->id,
            'nama' => $this->nama,
            'img_produk' => $this->img_produk,
            'harga' => $this->harga,
            'rating' => $this->rating,
            'deskripsi' => $this->deskripsi,
            'id_desainer' => $this->id_desainer,
            'id_konveksi' => $this->id_konveksi,
        ];
    }
}
