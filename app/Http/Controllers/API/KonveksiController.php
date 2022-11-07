<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Konveksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonveksiController extends Controller
{
    public function index()
    {
        $konveksi = DB::table('konveksi')
                    ->join('kategori', 'konveksi.id_kategori', '=','kategori.id')
                    ->join('tarif', 'konveksi.id_tarif', '=','tarif.id')
                    ->join('pengalaman_konveksi', 'konveksi.id_pengalaman', '=','pengalaman_konveksi.id')
                    ->select('konveksi.id as id','konveksi.img_profil as img_profil','konveksi.nama as nama','konveksi.bio as bio','konveksi.rating as rating','konveksi.link_wa as link_wa','konveksi.link_porto as link_porto','konveksi.jmlh_project as jmlh_project','kategori.nama_kategori as kategori','tarif.tag as tarif')
                    ->get();
        $count = Konveksi::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'konveksi'=>$konveksi]);
    }
 
    public function desc_rating(){
        $konveksi = DB::table('konveksi')
                    ->join('kategori', 'konveksi.id_kategori', '=','kategori.id')
                    ->join('tarif', 'konveksi.id_tarif', '=','tarif.id')
                    ->join('pengalaman_konveksi', 'konveksi.id_pengalaman', '=','pengalaman_konveksi.id')
                    ->select('konveksi.id as id','konveksi.img_profil as img_profil','konveksi.nama as nama','konveksi.bio as bio','konveksi.rating as rating','konveksi.link_wa as link_wa','konveksi.link_porto as link_porto','konveksi.jmlh_project as jmlh_project','kategori.nama_kategori as kategori','tarif.tag as tarif')
                    ->orderBy('konveksi.rating', 'DESC')
                    ->limit(5)
                    ->get();
        $count = Konveksi::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'konveksi'=>$konveksi]);
    }

    public function store(Request $request)
    {
        $konveksi = Konveksi::create($request->all());

        return response()->json($konveksi, 201);
    }
 
    public function show(Konveksi $konveksi)
    {
        return response()->json(['Konveksi'=>$konveksi]);
    }
 
    public function update(Request $request, Konveksi $konveksi)
    {
        $konveksi->update($request->all());

        return response()->json($konveksi, 200);
    }
 
    public function destroy(Konveksi $konveksi)
    {
     $konveksi->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
}
