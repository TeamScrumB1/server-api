<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = DB::table('payment')
                    ->get();
        $count = Payments::count();
        return response()->json(['status'=>'ok','totalResults'=>$count ,'payments'=>$payments]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'keterangan'     => 'required',
            'nominal'   => 'required',
            'bukti_tf'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('bukti_tf');
        $image->storeAs('public/image_buktitf', $image->hashName());

        //create post
        $post = Payments::create([
            'keterangan'     => $request->keterangan,
            'nominal'     => $request->nominal,
            'bukti_tf'   => $image->hashName(),
            'status'     => $request->status,
        ]);

        //return response
        return response()->json("Data berhasil ditambahkan", 200);
    }
}
