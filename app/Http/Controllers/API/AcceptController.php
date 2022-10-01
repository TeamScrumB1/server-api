<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcceptController extends Controller
{
    public function accept_desainer(Request $request, $id)
    {
        $project = Project::where('id', $id)
                    ->update(['id_desainer'=> $request->id_desainer]);
       
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

    public function accept_konveksi(Request $request, $id)
    {
        $project = Project::where('id', $id)
                    ->update(['id_konveksi'=> $request->id_konveksi]);

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
