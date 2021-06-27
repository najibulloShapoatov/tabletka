<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index(){

        if(Auth::check() && Auth::user()->role == 1){
            return view('admin.index');
        }
        if(Auth::check() && Auth::user()->role == 2){
            return  redirect('/');
        }
        return view('admin.auth.login');
    }
}
