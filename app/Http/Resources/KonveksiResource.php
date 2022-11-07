<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KonveksiResource extends JsonResource
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
            'img_profil' => $this->img_profil,
            'nama' => $this->nama,
            'bio' => $this->bio,
            'rating' => $this->rating,
            'link_wa' => $this->link_wa,
            'link_porto' => $this->link_porto,
            'jmlh_project' => $this->jmlh_project,
            'id_kategori' => $this->id_kategori,
            'id_tarif' => $this->id_tarif,
            'id_pengalaman' => $this->id_pengalaman,
        ];
    }
}
