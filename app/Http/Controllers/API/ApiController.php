<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $login = Auth::Attempt($request->all());
        if ($login) {
            $user = Auth::user();
            $user->api_token = Str::random(100);
            // $user->save();
            // $user->makeVisible('api_token');

            return response()->json([
                'response_code' => 200,
                'message' => 'Login Berhasil',
                'conntent' => $user
            ]);
        }else{
            return response()->json([
                'response_code' => 404,
                'message' => 'Username atau Password Tidak Ditemukan!'
            ]);
        }
    }
}