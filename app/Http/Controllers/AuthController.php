<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{

    // TODO: show login form
    public function login(Request $request){
       
    }

    // TODO: authenticate user
    public function authenticate(Request $request){
        $validate = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            return response()->json([]);
        }
        return response()->json(['message' => 'login gagal'], 400);
    }

    // TODO: show registration form
    public function register(){
        return view('');
    }

    // TODO: register user 
    public function registration(Request $request)
    {
    }
}
