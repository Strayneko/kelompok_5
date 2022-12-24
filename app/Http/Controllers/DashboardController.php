<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //TODO: show index
    public function index()
    {
        return view('dashboard.index');
    }
}
