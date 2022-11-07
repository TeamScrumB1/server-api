<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konveksi extends Model
{
    protected $guarded = [];
    protected $cast =[
        'id' => 'integer'
    ];
    protected $table ='konveksi';
    protected $fillable =['img_profil','nama','bio','rating','link_wa','link_porto','jmlh_project','id_kategori','id_tarif','id_pengalaman'];

    use HasFactory;
}
