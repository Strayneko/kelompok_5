<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    // TODO: show users list
    public function index()
    {
        return view('dashboard.index', ['users' => User::query()->orderBy('role_id')->get()]);
    }

    // TODO: make user to admin
    public function addAdmin()
    {
    }
}
