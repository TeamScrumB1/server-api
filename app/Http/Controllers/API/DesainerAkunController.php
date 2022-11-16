<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DesainerAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DesainerAkunController extends Controller
{
    public function index()
    {
        $desainer_akun = DB::table('desainer_akun')
                        ->get();
        $count = DesainerAkun::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'desainer_akun'=>$desainer_akun]);
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_desainer' => 'required',
            'npwp' => 'required',
            'foto_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_portofolio' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $image1 = $request->file('foto_ktp');
            $image1->storeAs('public/image_desainer/ktp', $image1->hashName());

            $image2 = $request->file('foto_logo');
            $image2->storeAs('public/image_desainer/logo', $image2->hashName());

            $post = DesainerAkun::create([ 
                'nama' => $request->input('nama'),
                'email' => $request->input('email'), 
                'password' => $request->input('password'), 
                'alamat' => $request->input('alamat'), 
                'foto_ktp' => 'https://api.yufagency.com/storage/image_desainer/ktp/'.$image1->hashName(),
                'nama_desainer' => $request->input('nama_desainer'),
                'npwp' => $request->input('npwp'),
                'foto_logo' => 'https://api.yufagency.com/storage/image_desainer/logo/'.$image2->hashName(),
                'link_portofolio' => $request->input('link_portofolio'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Sign Up Successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sign Up Failed',
                ], 401);
            }
        }
    }
 
    public function show(DesainerAkun $desainer_akun)
    {
        return response()->json(['desainer_akun'=>$desainer_akun]);
    }
 
    public function update(Request $request, DesainerAkun $desainer_akun)
    {
        $desainer_akun->update($request->all());

        return response()->json($desainer_akun, 200);
    }
 
    public function destroy(DesainerAkun $desainer_akun)
    {
     $desainer_akun->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
}
