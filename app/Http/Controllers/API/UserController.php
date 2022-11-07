<?php

namespace App\Http\Controllers\API;
use App\Models\User2;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $user = User2::get();
        $count = User2::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'user'=>$user]);
    }

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'username'  => 'required|unique:user,username',
            'email' => 'required|unique:user,email',
            'level' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please Fill Out The Entire Form!',
                'data'    => $validator->errors()
            ],401);

        } else {
            $post = User2::create([
                'username' => $request->input('username'), 
                'email' => $request->input('email'), 
                'password' => $request->input('password'), 
                'level' => $request->input('level'), 
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Sign up Successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Input Failed',
                ], 401);
            }
        }
    }

    public function getUser(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $user = DB::table('user')
                    ->select('username','email','password','level')
                    ->where('username', $username)
                    ->where('password', $password)
                    ->first();
        $count = User2::count();
        
        if ($user != null) {
            return response()->json(['status'=>'ok','totalResults'=>$count ,'user'=>$user]);
        }else{
            return response()->json(['status'=>'500']);
        }
        
    }
    
}
