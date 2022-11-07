<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = DB::table('keranjang')
                ->join('produk', 'keranjang.id_produk', '=','produk.id')
                ->select('keranjang.id as id','produk.id as id_produk','produk.nama as nama','produk.img_produk as img_produk','produk.img_processing as img_processing','keranjang.id_customer as id_customer','keranjang.jumlah as jumlah','produk.harga as harga','keranjang.total_harga as total_harga','produk.rating as rating','produk.deskripsi as deskripsi')
                ->get();
        $count = Keranjang::count();
        return response()->json(['status'=>'ok','totalResults'=>$count,'keranjang'=>$keranjang]);
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_produk' => 'required',
            'id_customer' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'total_harga' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $post = Keranjang::create([ 
                'id_produk' => $request->input('id_produk'), 
                'id_customer' => $request->input('id_customer'), 
                'jumlah' => $request->input('jumlah'), 
                'harga' => $request->input('harga'), 
                'total_harga' => $request->input('total_harga'), 
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Add Cart Successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Add Cart Failed',
                ], 401);
            }
        }
    }
 
    public function show(Keranjang $keranjang)
    {
        return response()->json(['keranjang'=>$keranjang]);
    }
 
    public function update(Request $request, Keranjang $keranjang)
    {
        $keranjang->update($request->all());

        return response()->json($keranjang, 200);
    }
 
    public function destroy(Keranjang $keranjang)
    {
     $keranjang->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
}
