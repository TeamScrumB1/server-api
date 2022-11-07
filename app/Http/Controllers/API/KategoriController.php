<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')
                    ->get();
        $count = Kategori::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'kategori'=>$kategori]);
    }
 
 
    public function store(Request $request)
    {
        $kategori = Kategori::create($request->all());

        return response()->json($kategori, 201);
    }
 
    public function show(Kategori $kategori)
    {
        return response()->json(['Kategori'=>$kategori]);
    }
 
    public function update(Request $request, Kategori $kategori)
    {
        $kategori->update($request->all());

        return response()->json($kategori, 200);
    }
 
    public function destroy(Kategori $kategori)
    {
     $kategori->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
 }