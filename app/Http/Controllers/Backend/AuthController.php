<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // TODO: show login form

    // TODO: authenticate user
    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->route('auth.login');
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

        $getRequest['role_id'] = 1;
        if ($request->file('image')) {
            $imgFile = $request->file('image');
            // $path = ;
            $getRequest['image'] =  $request->getSchemeAndHttpHost() . "/storage/" . $imgFile->store('image/', 'public');
        } else {
            $getRequest['image'] = 'default.jpg';
        }

        $user =  User::create($getRequest);
        return response()->json([
            'status_code' => 200,
            'status' => true,
            'data' => $user,
        ], 200);
    }

    public function logout()
    {
        session()->forget('logged_in');
        return response()->json([
            'message' => 'logged out'
        ], 200);
    }
}
