<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User2 extends Model
{
    protected $guarded = [];
    protected $table ='user';
    protected $fillable =['nama','username','email','password','level'];

    use HasFactory;
}
