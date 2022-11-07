<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtasanController extends Controller
{
    public function index()
    {
        $produk= DB::table('produk')
                 ->join('kategori', 'produk.id_kategori', '=', 'kategori.id')
                 ->select('produk.img_produk','produk.img_processing')
                 ->whereIn('kategori.id', array(2, 3))
                 ->get();

        $count = Produk::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }
}