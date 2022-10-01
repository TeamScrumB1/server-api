<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table ='project';
    protected $primaryKey = 'id';
    protected $fillable =[
        'id_user',
        'judul',
        'kebutuhan',
        'biaya',
        'lampiran',
        'size',
        'link_gambar',
        'id_desainer',
        'id_konveksi',
    ];
}
