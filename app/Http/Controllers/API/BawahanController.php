<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BawahanController extends Controller
{
    public function index()
    {
        $produk= DB::table('produk', 'kategori')
                 ->select('produk.img_produk','produk.img_processing')
                 ->whereIn('kategori.id', array(1,4,5,6))
                 ->get();

        $count = Produk::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }
}
