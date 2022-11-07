<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ='payment';
    protected $primaryKey = 'id';
    protected $fillable =['keterangan','nominal','bukti_tf','status'];
}
