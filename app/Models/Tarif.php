<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $guarded = [];
    protected $table ='tarif';
    use HasFactory;
}
