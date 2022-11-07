<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table ='keranjang';
    protected $primaryKey = 'id';
    protected $fillable =[
        'id_produk',
        'id_customer',
        'jumlah',
        'harga',
        'total_harga',
    ];
}
