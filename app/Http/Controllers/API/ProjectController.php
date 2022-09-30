<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function index(){
        $project = Project::get();
        $count = Project::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'project'=>$project]);
    }

    public function riwayat($id_user)
    {
        $project = DB::table('project')
                    ->select('project.id_user','project.judul','project.kebutuhan','project.biaya','project.lampiran', 'project.created_at','project.updated_at')
                    ->where('project.id_user', $id_user)
                    ->get();
        $count = Project::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'project'=>$project]);
    }

    public function store(Request $request)
    {
        $project = Project::create($request->all());

        return response()->json($project, 201);
    }
 
    public function show(Project $project)
    {
        return response()->json(['Project'=>$project]);
    }
 
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return response()->json($project, 200);
    }
 
    public function destroy(Project $project)
    {
     $project->delete();
 
     return response()->json('Berhasil Delete', 204);
    }
}
