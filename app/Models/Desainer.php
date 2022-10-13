<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desainer extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table ='desainer';
    protected $primaryKey = 'id';
    protected $fillable =['img_profil','nama','bio','rating','link_wa','link_porto','gender','jmlh_project','id_kategori','id_tarif','id_pengalaman'];
}
