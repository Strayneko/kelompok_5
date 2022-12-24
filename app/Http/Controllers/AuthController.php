<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthViewController extends Controller{
  public function login(){
    return view('auth.login');
  }
  public function register(){
    return view('auth.register');
  }
}