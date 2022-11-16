<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesainerAkun extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table ='desainer_akun';
    protected $primaryKey = 'id';
    protected $fillable =[
        'nama',
        'email',
        'password',
        'alamat',
        'nama_desainer',
        'npwp',
        'foto_ktp',
        'foto_logo',
        'link_portofolio',
    ];
}
