<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AspirationController extends Controller
{
    //TODO: show store aspiration
    public function store(Request $request){
        $payload = [
            'user_id' => $request->input('user_id'),
            'title' => $request->input("title"),
            'content' => $request->input("content"),
            'image' => $request->getSchemeAndHttpHost() . '/storage/' .  $request->image->store("aspirations", "public"),
            'status' => 0
        ];

        $validate = Validator::make($payload, [
            "title" => 'required',
            "content" => 'required',
            "image" => 'required',
            'image' => 'required'
        ]);
        if ($validate->fails()) return [
            'status_code' => 400,
            'status' => false,
            'message' => $validate->messages()->all()
        ];

        $aspirasi = Aspiration::query()->create($payload);

        return response()->json([
            'status_code' => 201,
            'status' => true,
            'message' => "Data Berhasil Dibuat!",
            'data' => $aspirasi
        ]);
    }

    // TODO: show all aspirations data by userId
    public function getAspiById($id){
        $getData = Aspiration::where('user_id', $id)->get();
        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => $getData
        ], 200);
    }

    // TODO: show all aspirations data
    public function index()
    {
        $aspirasi = Aspiration::latest()->get();
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


        $validate = Validator::make($aspirasi);
        if ($validate->fails()) return [
            'status_code' => 400,
            'status' => false,
            'message' => $validate->messages()->all()
        ];
    
        

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


        $validate = Validator::make($aspirasi);
        if ($validate->fails()) return [
            'status_code' => 400,
            'status' => false,
            'message' => $validate->messages()->all()
        ];

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => "Data Berhasil Didapatkan",
            'data' => $aspirasi
        ]);
    }

    // TODO: delete specific aspiration data by id
    public function destroy($id, Request $request)
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
        $imageName = Str::of($aspirasi->image)->remove($request->getSchemeAndHttpHost() . '/storage/');
        Storage::disk('public')->delete($imageName);


        $validate = Validator::make($aspirasi);
        if ($validate->fails()) return [
            'status_code' => 400,
            'status' => false,
            'message' => $validate->messages()->all()
        ];
        $aspirasi->delete();

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => "Data Berhasil Dihapus",
            'data' => []
        ]);
    }

    public function changeStatus($id)
    {
        $status = Aspiration::find($id);
        if (!$status) {
            return response()->json([
                'status_code' => 404,
                'status' => false,
                'message' => "ID aspiration tidak ditemukan",
                'data' => []
            ]);
        }


        $validate = Validator::make($status);
        if ($validate->fails()) return [
            'status_code' => 400,
            'status' => false,
            'message' => $validate->messages()->all()
        ];

        $payload = [
            'status' => 1
        ];

        $status->update($payload);

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => "status sudah dibaca"
        ]);
    }
}
