<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::orderBy('user_fullname','asc')->get();

            return DataTables::of($data)->addIndexColumn()
                            ->addColumn('aksi',function($data){
                                return '<div class="d-flex justify-content-start align-items-center gap-3">
                                    <div class="btn btn-primary btn-edit">
                                        <i class="bi bi-pencil"></i>
                                    </div>
                                    <div class="btn btn-danger btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </div>
                                </div>';
                            })
                            ->rawColumns(['aksi'])
                            ->make(true);
        }
        return view('Master.index');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'fullname' => 'required|string',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required|min:6|confirmed',
        ],[
            'email.unique' => 'Email Sudah Di Gunakan!',
            'password.min' => 'Password Minimal 6 Karakter',
            'password.confirmed' => 'Password Konfirmasi Tidak Sama'
        ]);

        if($validation->fails()){
            return back()->with('errors',$validation->errors()->first())->withInput();
        }

        User::create([
            'user_fullname' => $request->fullname,
            'user_email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success','Data Berhasil Di Simpan !');
    }

    public function update(Request $request)
    {
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
            return back()->with('errors',$validation->errors()->first())->withInput();
        }

        if($request->password){
            User::where('user_id', $request->id)->update([
                'user_fullname' => $request->fullname,
                'user_email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return back()->with('success','Data Berhasil Di Update !');
        }

        User::where('user_id', $request->id)->update([
            'user_fullname' => $request->fullname,
            'user_email' => $request->email,
        ]);

        return back()->with('success','Data Berhasil Di Update !');
    }

    public function delete(Request $request)
    {
        $data = User::where('user_id',$request->id)->first();
        if($data){
            $data = User::where('user_id',$request->id)->delete();
            if($data){
                return response()->json([
                    'status' => 200,
                    'message' => 'User Berhasil Di Hapus'
                ],200);
            }
            return response()->json([
                'status' => 400,
                'message' => 'Terjadi Kesalahan, Silahkan Coba Lagi !'
            ],400);
        }

        return response()->json([
            'status' => 404,
            'message' => 'User Tidak Di Temukan !'
        ],400);
    }
}
