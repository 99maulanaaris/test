<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function authentication(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'password' => 'required',
            'email' => 'required|email',
            'captcha' => 'required|captcha'
        ],[
            'captcha.captcha' => 'Captha Tidak Sesuai !'
        ]);

        if($validasi->fails()){
            return back()->with('errors',$validasi->errors()->first());
        }

        $user = User::where('user_email',$request->email)->first();

        if(!$user){
            return back()->with('errors','User Tidak Terdaftar');
        }

        if(!Hash::check($request->password,$user->password)){
            return back()->with('errors','Password Tidak Valid !');
        }

        if(Auth::attempt(['user_email' => $request->email, 'password' => $request->password])){
            User::where('user_id', $user->user_id)->update([
                'user_status' => 1
            ]);
            return redirect()->intended('/');
        }

        return back()->with('errors','Terjadi Kesalahan Harap Coba Lagi !');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function createdUser(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'fullname' => 'required|string',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required|string|min:6',
            'captcha' => 'required|captcha'
        ],[
            'captcha.captcha' => 'Captha Tidak Sesuai !'
        ]);

        if($validasi->fails()){
            return back()->with('errors',$validasi->errors()->first());
        }

        User::create([
            'user_fullname' => $request->fullname,
            'user_email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->to(route('login'))->with('success','Berhasil Register !');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function logout()
    {
        User::where('user_id',auth()->user()->user_id)->update([
            'user_status' => 0
        ]);
        Auth::logout();
        return redirect()->to(route('login'))->with('success','Berhasil Logout');
    }

}
