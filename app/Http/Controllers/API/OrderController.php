<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

class OrderController extends Controller
{   
    public function index(){
        $project = Project::get();
        $count = Project::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'project'=>$project]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'judul' => 'required',
            'kebutuhan' => 'required',
            'biaya' => 'required',
            'lampiran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $image = $request->file('lampiran');
            $image->storeAs('public/image_project', $image->hashName());
            $size = $request->file('lampiran')->getSize();
            $total_size = number_format($size / 1048576,2); //MB

            $post = Project::create([ 
                'id_user' => $request->input('id_user'), 
                'judul' => $request->input('judul'), 
                'kebutuhan' => $request->input('kebutuhan'), 
                'biaya' => $request->input('biaya'), 
                'lampiran' => $image->hashName(),
                'size' => $total_size,
                'link_gambar' => 'https://api.yufagency.com/public/image_project/'.$image->hashName(), 
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Preorder Successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Preorder Failed',
                ], 401);
            }
        }
    }
}

?>
 