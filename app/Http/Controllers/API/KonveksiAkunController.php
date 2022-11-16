<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KonveksiAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KonveksiAkunController extends Controller
{
    public function index()
    {
        $konveksi_akun = DB::table('konveksi_akun')
                        ->get();
        $count = KonveksiAkun::count();
        return response()->json(['status'=>'ok','totalResults'=>$count, 'konveksi_akun'=>$konveksi_akun]);
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_konveksi' => 'required',
            'alamat_konveksi' => 'required',
            'nib' => 'required',
            'npwp' => 'required',
            'no_telepon' => 'required',
            'email_konveksi' => 'required',
            'foto_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_tempat_usaha' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $image1 = $request->file('foto_ktp');
            $image1->storeAs('public/image_konveksi/ktp', $image1->hashName());

            $image2 = $request->file('foto_logo');
            $image2->storeAs('public/image_konveksi/logo', $image2->hashName());

            $image3 = $request->file('foto_tempat_usaha');
            $image3->storeAs('public/image_konveksi/tempat_usaha', $image2->hashName());

            $post = KonveksiAkun::create([ 
                'nama' => $request->input('nama'),
                'email' => $request->input('email'), 
                'password' => $request->input('password'), 
                'alamat' => $request->input('alamat'), 
                'foto_ktp' => 'https://api.yufagency.com/storage/image_konveksi/ktp/'.$image1->hashName(),
                'nama_konveksi' => $request->input('nama_konveksi'),
                'alamat_konveksi' => $request->input('alamat_konveksi'),
                'nib' => $request->input('nib'),
                'npwp' => $request->input('npwp'),
                'no_telepon' => $request->input('no_telepon'),
                'email_konveksi' => $request->input('email_konveksi'),
                'foto_logo' => 'https://api.yufagency.com/storage/image_konveksi/logo/'.$image2->hashName(),
                'foto_tempat_usaha' => 'https://api.yufagency.com/storage/image_konveksi/tempat_usaha/'.$image3->hashName(),
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
 
    public function show(KonveksiAkun $konveksi_akun)
    {
        return response()->json(['konveksi_akun'=>$konveksi_akun]);
    }
 
    public function update(Request $request, KonveksiAkun $konveksi_akun)
    {
        $konveksi_akun->update($request->all());

        return response()->json($konveksi_akun, 200);
    }
 
    public function destroy(KonveksiAkun $konveksi_akun)
    {
     $konveksi_akun->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
}
