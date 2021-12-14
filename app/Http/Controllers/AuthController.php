<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validateData = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
            'imei' => 'required',
        ]);
        if($validateData->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validateData->errors(),
                    ]);

        }else{
            $user = User::where('username', $request->username)->first();
            if($user){
                if(Hash::check($request->password, $user->password)){
                    if($request->imei == $user->imei){
                        return response()->json([
                            'success' => true,
                            'message' => 'Login Berhasil',
                        ]);
                    }else{
                        return response()->json([
                            'success' => false,
                            'message' => 'Password salah',
                        ]);
                    }

                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password salah',
                    ]);
                }
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ada',
                ]);
            }
        }
    }
    public function ticket(Request $request){

    }
}
