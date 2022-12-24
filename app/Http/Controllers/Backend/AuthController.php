<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // TODO: show login form

    // TODO: authenticate user
    public function authenticate(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($validate->validated())){
            $request->session()->regenerate();
            session()->put('logged_in', Auth::user()->id);
            return redirect()->intended('/aspiration/create');
        }
        return redirect()->back()->withErrors(['message' => 'Login errors']);
    }

    // TODO: register user 
    public function registration(Request $request)
    {
        $getRequest = $request->all();
        $validate = Validator::make($getRequest, [
            "email" => 'required|email',
            "password" => 'required',
            "name" => 'required',
            'image' => 'required',
            'gender' => 'required',
            'birth_date' => 'required'
        ]);
        if ($validate->fails()) return [
            'status_code' => 400,
            'status' => false,
            'message' => $validate->messages()->all()
        ];
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
            'message' => 'Success! Kamu telah terdaftar sebagai user!',
            'data' => $user,
        ], 200);
    }

    public function checkSession($id)
    {
    }
    public function logout(){
        Auth::logout();
        session()->forget('logged_in');
        return redirect()->route('auth.login');
    }
}
