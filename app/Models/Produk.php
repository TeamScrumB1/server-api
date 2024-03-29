<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    protected $table ='produk';
    protected $primaryKey = 'id';
    protected $fillable =[
        'nama',
        'img_produk',
        'img_processing',
        'harga',
        'rating',
        'deskripsi',
        'id_kategori',
        'id_desainer',
        'id_konveksi'
    ];
}
