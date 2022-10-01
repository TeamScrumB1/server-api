<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RequestProjectKonveksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RequestProjectKonveksiController extends Controller
{
    public function index()
    {
        $request_project_konveksi = RequestProjectKonveksi::get();
        $count = RequestProjectKonveksi::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'requestProjectKonveksi'=>$request_project_konveksi]);
    }
 
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'id_project' => 'required',
            'id_konveksi' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $post = RequestProjectKonveksi::create([
                'id_project' => $request->input('id_project'), 
                'id_konveksi' => $request->input('id_konveksi'), 
                'status' => 'menunggu', 
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Request Successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Input Failed',
                ], 401);
            }
        }
    }
 
    public function show(RequestProjectKonveksi $request_project_konveksi)
    {
        return response()->json(['RequestProjectDesainer'=>$request_project_konveksi]);
    }
 
    public function update(Request $request, RequestProjectKonveksi $request_project_konveksi)
    {
        $request_project_konveksi->update($request->all());

        return response()->json($request_project_konveksi, 200);
    }
 
    public function destroy(RequestProjectKonveksi $request_project_konveksi)
    {
        $request_project_konveksi->delete();
        
        return response()->json('Berhasil Delete', 204);
    }
}
