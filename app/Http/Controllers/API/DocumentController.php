<?php
 
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response,File;
use App\Models\Document;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DocumentController extends Controller
{
 
    public function index(){
        $project = Document::get();
        $count = Document::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'Document'=>$project]);
    }

    public function store(Request $request)
    {
 
       $validator = Validator::make($request->all(), 
              [ 
              'user_id' => 'required',
              'file' => 'required|mimes:doc,docx,pdf,txt,png,jpg|max:2048',
             ]);   
 
    if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        
         }  
 
  
        if ($files = $request->file('file')) {
             
            //store file into document folder
            $file = $request->file->store('public/documents');
 
            //store your file into database
            $document = new Document();
            $document->title = $file;
            $document->user_id = $request->user_id;
            $document->created_at = Carbon::now()->toDateTimeString();
            $document->updated_at = Carbon::now()->toDateTimeString();
            $document->save();
              
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
  
        }
 
  
    }
}