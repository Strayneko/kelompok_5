<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aspiration;

class AspirationController extends Controller
{
    // TODO: show all aspirations data
    public function index()
    {
        return view('aspirations.index');
    }

    public function create()
    {
        return view('aspirations.create');
    }

    // TODO: show update form
    public function edit(Request $request, $id)
    {
    }


    // TODO: show detail aspiration by the given id
    public function show($id)
    {
        return view('aspirations.show');
    }

    public function getAspiByid()
    {
        return view('aspirations.user');
    }
}
