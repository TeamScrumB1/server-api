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
                ->select('produk.id as id','produk.nama as nama','produk.img_produk as img_produk','produk.harga as harga','produk.rating as rating','produk.deskripsi as deskripsi','produk.id_desainer as id_desainer','desainer.img_profil as img_profil','desainer.nama as nama_desainer','desainer.bio as bio_desainer','desainer.rating as rating_desainer','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.jmlh_project as jmlh_project','kategori.nama_kategori as kategori')
                ->orderBy('produk.rating', 'DESC')
                ->get();
        $count = Produk::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }

    public function filter_kategori($nama_kategori)
    {
        $produk = DB::table('produk')
                ->join('desainer', 'produk.id_desainer', '=','desainer.id')
                ->join('kategori', 'desainer.id_kategori', '=','kategori.id')
                ->select('produk.id as id','produk.nama as nama','produk.img_produk as img_produk','produk.harga as harga','produk.rating as rating','produk.deskripsi as deskripsi','produk.id_desainer as id_desainer','desainer.img_profil as img_profil','desainer.nama as nama_desainer','desainer.bio as bio_desainer','desainer.rating as rating_desainer','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.jmlh_project as jmlh_project','kategori.nama_kategori as kategori')
                ->where('produk.nama_kategori', $nama_kategori)
                ->get();
        $count = Produk::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'produk'=>$produk]);
    }
 
    public function store(Request $request)
    {
        $produk = Produk::create($request->all());

        return response()->json($produk, 201);
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