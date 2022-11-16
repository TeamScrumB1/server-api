<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonveksiAkun extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table ='konveksi_akun';
    protected $primaryKey = 'id';
    protected $fillable =[
        'nama',
        'email',
        'password',
        'alamat',
        'foto_ktp',
        'nama_konveksi',
        'alamat_konveksi',
        'nib',
        'npwp',
        'no_telepon',
        'email_konveksi',
        'foto_logo',
        'foto_tempat_usaha',
    ];
}
