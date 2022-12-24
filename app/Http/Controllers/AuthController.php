<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //TODO: show register form
    public function register()
    {
        return view('auth.register');
    }
}
