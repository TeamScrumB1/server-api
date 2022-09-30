<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{   
    public function index(){
        $project = Project::get();
        $count = Project::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'project'=>$project]);
    }
    
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'judul' => 'required',
            'kebutuhan' => 'required',
            'biaya' => 'required',
            'lampiran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size' => 'required',
            'link_gambar' => 'required',
            'created_at' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $lampiran = $request->file('lampiran')->store('lampiran','public');
            //$lampiran->storeAs('public/image_project', $lampiran->hashName());    
          

            $post = Order::create([
                'id_user' => $request->input('id_user'), 
                'judul' => $request->input('judul'), 
                'kebutuhan' => $request->input('kebutuhan'), 
                'biaya' => $request->input('biaya'), 
                'lampiran' => $lampiran,
                'size' => $request->input('size'), 
                'link_gambar' => $request->input('link_gambar'), 
                'created_at' => $request->input(time()), 
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Preorder Successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Input Failed',
                ], 401);
            }
        }
    }
}

?>
 