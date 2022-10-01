<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProjectDesainer extends Model
{
    protected $guarded = [];
    protected $cast =[
        'id' => 'integer'
    ];
    protected $table ='request_project_desainer';
    protected $fillable =['id_project','id_desainer','status'];

    use HasFactory;
}
