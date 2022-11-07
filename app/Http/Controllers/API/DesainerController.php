<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Desainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DesainerController extends Controller
{
    public function index()
    {
        $desainer = DB::table('desainer')
                    ->join('kategori', 'desainer.id_kategori', '=','kategori.id')
                    ->join('tarif', 'desainer.id_tarif', '=','tarif.id')
                    ->join('pengalaman_desainer', 'desainer.id_pengalaman', '=','pengalaman_desainer.id')
                    ->select('desainer.id as id','desainer.img_profil as img_profil','desainer.nama as nama','desainer.bio as bio','desainer.rating as rating','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.gender as gender','desainer.jmlh_project as jmlh_project','kategori.nama_kategori as kategori','tarif.tag as tarif')
                    ->get();
        $count = Desainer::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'desainer'=>$desainer]);
    }
 
    public function desc_rating(){
        $desainer = DB::table('desainer')
                    ->join('kategori', 'desainer.id_kategori', '=','kategori.id')
                    ->join('tarif', 'desainer.id_tarif', '=','tarif.id')
                    ->join('pengalaman_desainer', 'desainer.id_pengalaman', '=','pengalaman_desainer.id')
                    ->select('desainer.id as id','desainer.img_profil as img_profil','desainer.nama as nama','desainer.bio as bio','desainer.rating as rating','desainer.link_wa as link_wa','desainer.link_porto as link_porto','desainer.gender as gender','desainer.jmlh_project as jmlh_project','kategori.nama_kategori as kategori','tarif.tag as tarif')
                    ->orderBy('desainer.rating', 'DESC')
                    ->limit(5)
                    ->get();
        $count = Desainer::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'desainer'=>$desainer]);
    }
 
    public function store(Request $request)
    {
        $desainer = Desainer::create($request->all());

        return response()->json($desainer, 201);
    }
 
    public function show(Desainer $desainer)
    {
        return response()->json(['Desainer'=>$desainer]);
    }
 
    public function update(Request $request, Desainer $desainer)
    {
        $desainer->update($request->all());

        return response()->json($desainer, 200);
    }
 
    public function destroy(Desainer $desainer)
    {
     $desainer->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
 }