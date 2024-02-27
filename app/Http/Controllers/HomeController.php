<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $aktif = User::where('user_status',1)->count();
        $user = User::count();
        return view('Home.index',compact('aktif','user'));
    }
}
