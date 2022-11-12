<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ProdukController extends Controller
{
    public function index()
    {
        $produk = DB::table('produk')
                ->join('desainer', 'produk.id_desainer', '=','desainer.id')
                ->join('kategori', 'desainer.id_kategori', '=','kategori.id')
                ->select('produk.id as id','produk.nama as nama','produk.img_produk as img_produk','produk.img_processing as img_processing','produk.harga as harga','produk.rating as rating','produk.deskripsi as deskripsi','produk.id_desainer as id_desainer','desainer.img_profil as img_profil','desainer.nama as nama_desainer','desainer.bio as bio_desainer','desainer.rating as rating_desainer','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.jmlh_project as jmlh_project','kategori.nama_kategori as kategori')
                ->get();
        $count = Produk::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }

    public function desc_rating()
    {
        $produk = DB::table('produk')
                ->join('desainer', 'produk.id_desainer', '=','desainer.id')
                ->join('kategori', 'desainer.id_kategori', '=','kategori.id')
                ->select('produk.id as id','produk.nama as nama','produk.img_produk as img_produk','produk.img_processing as img_processing','produk.harga as harga','produk.rating as rating','produk.deskripsi as deskripsi','produk.id_desainer as id_desainer','desainer.img_profil as img_profil','desainer.nama as nama_desainer','desainer.bio as bio_desainer','desainer.rating as rating_desainer','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.jmlh_project as jmlh_project','kategori.nama_kategori as kategori')
                ->orderBy('produk.rating', 'DESC')
                ->get();
        $count = $produk->count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }

    public function filter_kategori_id($id_kategori)
    {
        $produk = DB::table('produk')
                ->join('desainer', 'produk.id_desainer', '=','desainer.id')
                ->join('kategori', 'desainer.id_kategori', '=','kategori.id')
                ->select('produk.id as id','produk.nama as nama','produk.img_produk as img_produk','produk.img_processing as img_processing','produk.harga as harga','produk.rating as rating','produk.deskripsi as deskripsi','produk.id_desainer as id_desainer','desainer.img_profil as img_profil','desainer.nama as nama_desainer','desainer.bio as bio_desainer','desainer.rating as rating_desainer','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.jmlh_project as jmlh_project','produk.id_kategori as id_kategori')
                ->where('produk.id_kategori', $id_kategori)
                ->get();
        $count = $produk->count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }

    public function filter_kategori_nama($nama_kategori)
    {
        if($nama_kategori == 'Kemeja')
            $id_kategori = 1;
        elseif($nama_kategori == 'Rok')
            $id_kategori = 2;
        elseif($nama_kategori == 'Celana')
            $id_kategori = 3;
        elseif($nama_kategori == 'Gaun')
            $id_kategori = 4;
        elseif($nama_kategori == 'Jaket')
            $id_kategori = 5;
        elseif($nama_kategori == 'Kaos')
            $id_kategori = 6;
        else
            $id_kategori = 0;

        $produk = DB::table('produk')
                ->join('desainer', 'produk.id_desainer', '=','desainer.id')
                ->join('kategori', 'desainer.id_kategori', '=','kategori.id')
                ->select('produk.id as id','produk.nama as nama','produk.img_produk as img_produk','produk.img_processing as img_processing','produk.harga as harga','produk.rating as rating','produk.deskripsi as deskripsi','produk.id_desainer as id_desainer','desainer.img_profil as img_profil','desainer.nama as nama_desainer','desainer.bio as bio_desainer','desainer.rating as rating_desainer','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.jmlh_project as jmlh_project','produk.id_kategori as id_kategori')
                ->where('produk.id_kategori', $id_kategori)
                ->get();
        $count = $produk->count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'img_produk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_processing' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
            'rating' => 'required',
            'deskripsi' => 'required',
            'id_kategori' => 'required',
            'id_desainer' => 'required',
            'id_konveksi' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $image1 = $request->file('img_produk');
            $image1->storeAs('public/image_product', $image1->hashName());

            $image2 = $request->file('img_processing');
            $image2->storeAs('public/image_processing', $image2->hashName());

            $post = Produk::create([ 
                'nama' => $request->input('nama'), 
                'img_produk' => 'https://api.yufagency.com/storage/image_product/'.$image1->hashName(), 
                'img_processing' => 'https://api.yufagency.com/storage/image_processing/'.$image2->hashName(), 
                'harga' => $request->input('harga'), 
                'rating' => $request->input('rating'), 
                'deskripsi' => $request->input('deskripsi'), 
                'id_kategori' => $request->input('id_kategori'),
                'id_konveksi' => $request->input('id_konveksi'),
                'id_desainer' => $request->input('id_desainer'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Upload Product Successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Upload Product Failed',
                ], 401);
            }
        }
    }
 
    public function show(Produk $produk)
    {
        return response()->json(['produk'=>$produk]);
    }
 
    public function update(Request $request, Produk $produk)
    {
        $produk->update($request->all());

        return response()->json($produk, 200);
    }
 
    public function destroy(Produk $produk)
    {
     $produk->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
 }