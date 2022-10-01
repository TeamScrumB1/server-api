<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RequestProjectDesainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RequestProjectDesainerController extends Controller
{
    public function index(){
        $request_project_desainer = RequestProjectDesainer::get();
        $count = RequestProjectDesainer::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'requestProjectDesainer'=>$request_project_desainer]);
    }
 
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'id_project' => 'required',
            'id_desainer' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $post = RequestProjectDesainer::create([
                'id_project' => $request->input('id_project'), 
                'id_desainer' => $request->input('id_desainer'), 
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
 
    public function show(RequestProjectDesainer $request_project_desainer)
    {
        return response()->json(['RequestProjectDesainer'=>$request_project_desainer]);
    }
 
    public function update(Request $request, RequestProjectDesainer $request_project_desainer)
    {
        $request_project_desainer->update($request->all());

        return response()->json($request_project_desainer, 200);
    }
 
    public function destroy(RequestProjectDesainer $request_project_desainer)
    {
        $request_project_desainer->delete();
        
        return response()->json('Berhasil Delete', 204);
    }
}
