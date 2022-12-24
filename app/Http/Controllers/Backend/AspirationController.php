<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller{
    public function store(Request $request){
        $getRequest = $request->all();
        dd($getRequest);
        // $request->validate([
        //     'user_id' => ['required'],
        //     'title' => ['required'],
        //     'content' => ['required'],
        //     'image' => ['required'],
        //     'status' => ['required'],
        // ]);

        // if ($request->file('image')) {
        //     $imgFile = $request->file('image');
        //     // $path = ;
        //     $getRequest['image'] =  $request->getSchemeAndHttpHost() . "/storage/" . $imgFile->store('image/', 'public');
        // } else {
        //     $getRequest['image'] = 'default.jpg';
        // }

        // Aspiration::create($getRequest);
        // return response()->json([
        //     'status' => true,
        //     'message' => 'success',
        //     'data' => $request->all()
        // ], 200);
    }
    // public function index(){
        
    // }
}
