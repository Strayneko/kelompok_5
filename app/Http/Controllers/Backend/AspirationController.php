<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aspiration;

class AspirationController extends Controller
{
    //TODO: show store aspiration
    public function store(Request $request)
    {

        $payload = [
            'user_id' => $request->input('user_id'),
            'title' => $request->input("title"),
            'content' => $request->input("content"),
            'image' => $request->getSchemeAndHttpHost() . '/storage/' .  $request->image->store("aspirations", "public"),
            'status' => 0
        ];

        $aspirasi = Aspiration::query()->create($payload);

        return response()->json([
            'status_code' => 201,
            'status' => true,
            'message' => "Data Berhasil Dibuat!",
            'data' => $aspirasi
        ]);
    }

    // TODO: show all aspirations data
    public function index()
    {
        $aspirasi = Aspiration::query()->get();
        if (!$aspirasi) {
            return response()->json([
                'status_code' => 404,
                'status' => false,
                'message' => "Data Belum Tersedia",
                'data' => []
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => "Data Berhasil Didapatkan",
            'data' => $aspirasi
        ]);
    }

    // TODO: update aspiration data by the given id
    public function update(Request $request, $id)
    {
        $aspirasi = Aspiration::find($id);
        if (!$aspirasi) {
            return response()->json([
                'status_code' => 404,
                'status' => false,
                'message' => "ID tidak ada",
                'data' => []
            ]);
        }

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

        return response()->json([
            'status_code' => 201,
            'status' => true,
            'message' => "Data Berhasil Diubah",
            'data' => $aspirasi
        ]);
    }
    // TODO: show detail aspiration by the given id
    public function show($id)
    {
        $aspirasi = Aspiration::find($id);
        if (!$aspirasi) {
            return response()->json([
                'status_code' => 404,
                'status' => false,
                'message' => "ID tidak Ditemukan",
                'data' => []
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => "Data Berhasil Didapatkan",
            'data' => $aspirasi
        ]);
    }

    // TODO: delete specific aspiration data by id
    public function destroy($id)
    {
        $aspirasi = Aspiration::query()->where("id", $id)->delete();
        if (!$aspirasi) {
            return response()->json([
                'status_code' => 404,
                'status' => false,
                'message' => "ID tidak Ditemukan",
                'data' => []
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => "Data Berhasil Dihapus",
            'data' => []
        ]);
    }
}
