<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aspiration;

class AspirationController extends Controller
{
    //TODO: show store aspiration
    public function store(Request $request)
    {

        $payload = [
            'title' => $request->input("title"),
            'content' => $request->input("content"),
            'image' => $request->image->store("aspirations", "public")
        ]; 

        $aspirasi = Aspiration::query()->create($payload);
        return view('aspirations.create', compact('aspirasi'));

    }

    // TODO: show all aspirations data
    public function index()
    {
        $aspirasi = Aspiration::query()->get();

        return view('aspirations.index', compact('aspirasi'));
    }

    // TODO: show update form
    public function edit(Request $request, $id)
    {
    }


    // TODO: update aspiration data by the given id
    public function update(Request $request, $id)
    {
        $aspirasi = Aspiration::find($id);
        $aspirasi->title = $request->input('title');
        $aspirasi->content_response = $request->input('content_response');
        $aspirasi->status = $request->input('status');

        // cek input image
        if ($request->file("image")) {
            $file = $request->file("image");
            $filename = $file->hashName();
            $file->move("aspirations", $filename);
            $path = "/aspirations/" . $filename;

            $aspirasi->file = $path;
        }

        $aspirasi->update();

        return view('aspirations.index');
    }
    // TODO: show detail aspiration by the given id
    public function show($id)
    {
        $aspirasi = Aspiration::find($id);

        return view('', compact('aspirasi'));
    }

    // TODO: delete specific aspiration data by id
    public function destroy($id)
    {
        Aspiration::query()->where("id", $id)->delete();
        return redirect('aspirations.index');
    }
}
