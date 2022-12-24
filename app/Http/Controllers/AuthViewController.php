<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthViewController extends Controller
{

    // TODO: show login form
    public function login()
    {
        return view('auth.login');
    }

    // TODO: authenticate user
    // public function authenticate(Request $request)
    // {
    //     $validate = $request->validate([
    //         'email' => ['required'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($validate)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/');
    //     }
    //     return redirect()->route('auth.login');
    // }

    // TODO: show registration form
    public function register()
    {
        return view('auth.register');
    }

    // TODO: register user 
    // public function registration(Request $request)
    // {
    //     $getRequest = $request->all();
    //     $request->validate([
    //         "email" => ['required', 'email'],
    //         "password" => ['required'],
    //         "name" => ['required'],
    //         'image' => ['required'],
    //         'gender' => ['required'],
    //         'birth_date' => ['required']
    //     ]);
    //     $getRequest['role_id'] = 1;
    //     if ($request->file('image')) {
    //         $imgFile = $request->file('image');
    //         $getRequest['image'] =  $imgFile->store('image/', 'public');
    //     } else {
    //         $getRequest['image'] = 'default.jpg';
    //     }

    //     User::create($getRequest);
    //     return redirect()->route('auth.login')->with('message', 'Register Success');
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     session()->flush();
    //     return redirect()->route('auth.login')->with('message', 'logged out');
    // }
}