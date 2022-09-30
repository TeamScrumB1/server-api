<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcceptController extends Controller
{
    public function accept_desainer($id_project,$id_desainer)
    {
        $project = DB::table('project') 
                    ->where('id_project', $id_project)
                    ->update(['id_desainer', $id_desainer]);
        $count = Project::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'project'=>$project]);

        if ($project) {
            return response()->json([
                'success' => true,
                'message' => 'Accept Desainer Successful',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Input Failed',
            ], 401);
        }
    }

    public function accept_konveksi($id_project,$id_konveksi)
    {
        $project = DB::table('project') 
                    ->where('id_project', $id_project)
                    ->update(['id_konveksi', $id_konveksi]);
        $count = Project::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'project'=>$project]);

        if ($project) {
            return response()->json([
                'success' => true,
                'message' => 'Accept Konveksi Successful',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Input Failed',
            ], 401);
        }
    }

    

}
