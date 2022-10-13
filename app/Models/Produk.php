<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $table ='produk';
    protected $primaryKey = 'id';
    protected $fillable =['nama','img_produk','harga','rating','deskripsi','id_desainer','id_konveksi'];
}
