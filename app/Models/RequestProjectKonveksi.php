<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProjectKonveksi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $cast =[
        'id' => 'integer'
    ];
    protected $table ='request_project_konveksi';
    protected $fillable =['id_project','id_konveksi','status'];
}
