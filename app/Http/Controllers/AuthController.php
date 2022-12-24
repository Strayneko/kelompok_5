<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // TODO: show login form
    public function login()
    {
        return view('auth.login');
    }

    // TODO: authenticate user
    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return response()->json([]);
        }
        return redirect()->route('auth.login')->withErrors(['message' => 'login gagal']);
    }

    // TODO: show registration form
    public function register()
    {
        return view('auth.register');
    }

    // TODO: register user 
    public function registration(Request $request)
    {
        $getRequest = $request->all();
        $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required'],
            "name" => ['required'],
            'image' => ['required'],
            'gender' => ['required'],
            'birth_date' => ['required']
        ]);

        if ($request->file('image')) {
            $imgFile = $request->file('image');
            $getRequest['image'] =  $imgFile->store('image/', 'public');
        } else {
            $getRequest['image'] = 'default.jpg';
        }

        User::create($getRequest);
        return redirect()->route('auth.login')->with('message', 'Register Success');
    }
}
