<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authentication(Request $request)
    {
       try {
            $validasi = Validator::make($request->all(),[
                'password' => 'required',
                'email' => 'required|email',
            ]);

            if($validasi->fails()){
                return response()->json([
                    'meta' => [
                        'code' => 400,
                        'message' => $validasi->errors()->first()
                    ]
                ],400);
            }

            $user = User::where('user_email',$request->email)->first();

            if(!$user){
                return response()->json([
                    'meta' => [
                        'code' => 404,
                        'message' => 'User Tidak Di Temukan !'
                    ]
                ],404);
            }

            if(!Hash::check($request->password,$user->password)){
                return response()->json([
                    'meta' => [
                        'code' => 400,
                        'message' => 'Password Anda Salah !'
                    ]
                ],400);
            }

            if(Auth::attempt(['user_email' => $request->email, 'password' => $request->password])){
                User::where('user_id', $user->user_id)->update([
                    'user_status' => 1
                ]);
                $token = auth()->user()->createToken('API Token')->plainTextToken;
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'success'
                    ],
                    'token' => $token
                ],200);
            }
       } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            ],500);
       }
    }

    public function logout(Request $request)
    {
        try {
            $user = User::where('user_id',$request->id)->first();

            if($user->tokens()->delete()){
                User::where('user_id',$request->id)->update([
                    'user_status' => 0
                ]);
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Logout'
                    ]
                ],200);
            }
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => 'Gagal'
                ]
            ],500);
        } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            ],500);
        }
    }


}
