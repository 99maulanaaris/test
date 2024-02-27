<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MasterController extends Controller
{
    public function getData()
    {
        try {
            $data = User::orderBy('user_fullname','asc')->get();
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'success'
                ],
                'data' => $data
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            ],500);
        }
    }

    public function createUser(Request $request)
    {
        try {
            $validasi = Validator::make($request->all(),[
                'fullname' => 'required|string',
                'email' => 'required|email|unique:users,user_email',
                'password' => 'required|string|min:6'
            ]);

            if($validasi->fails()){
                return response()->json([
                    'meta' => [
                        'code' => 400,
                        'message' => $validasi->errors()->first()
                    ]
                ],400);
            }

            $data = User::create([
                'user_fullname' => $request->fullname,
                'user_email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'success create data'
                ],
                'data' => $data
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            ],500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[
                'fullname' => 'required|string',
                'email' => ['required','email', Rule::unique('users','user_email')->ignore($request->id,'user_id')],
                'password' => 'nullable|min:6|confirmed',
            ],[
                'email.unique' => 'Email Sudah Di Gunakan!',
                'password.min' => 'Password Minimal 6 Karakter',
                'password.confirmed' => 'Password Konfirmasi Tidak Sama'
            ]);

            if($validation->fails()){
                return response()->json([
                    'meta' => [
                        'code' => 400,
                        'message' => $validation->errors()->first()
                    ]
                ],400);
            }

            if($request->password){
                User::where('user_id', $request->id)->update([
                    'user_fullname' => $request->fullname,
                    'user_email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Success Update Data'
                    ]
                ],200);
            }

            User::where('user_id', $request->id)->update([
                'user_fullname' => $request->fullname,
                'user_email' => $request->email,
            ]);

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Success Update Data'
                ]
            ],200);


        } catch (\Exception $e) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            ],500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $validasi = Validator::make($request->only('id'),[
                'id' => 'required'
            ]);

            if($validasi->fails()){
                return response()->json([
                    'meta' => [
                        'code' => 400,
                        'message' => $validasi->errors()->first()
                    ]
                ],400);
            }
            $data = User::where('user_id',$request->id)->first();
            if($data){
                $data = User::where('user_id',$request->id)->delete();
                if($data){
                    return response()->json([
                        'meta' => [
                            'code' => 200,
                            'message' => 'User Berhasil Di Delete !'
                        ]
                    ],200);
                }
                return response()->json([
                    'meta' => [
                        'code' => 400,
                        'message' => 'Terjadi Kesalahan, Harap Coba Lagi'
                    ]
                ],400);
            }

            return response()->json([
                'meta' => [
                    'code' => 404,
                    'message' => 'User Tidak Di Temukan !'
                ]
            ],404);
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
