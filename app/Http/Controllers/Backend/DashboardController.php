<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    // TODO: show users list
    public function index()
    {
        // get all data with ordered by role_id
        $users =  User::query()->orderBy('role_id')
            ->get()
            ->makeHidden(['password']);
        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => 'Data successfully fetched',
            'data' => $users
        ]);
    }

    public function destroy($id, Request $request)
    {
        // find user by id
        $user = User::find($id);
        // return error message if user not found
        if (!$user) {
            return response()->json([
                'status_code' => 404,
                'status' => false,
                'message' => "ID User tidak ditemukan",
                'data' => []
            ]);
        }

        // remove url from image name
        $imageName = Str::of($user->image)->remove($request->getSchemeAndHttpHost() . '/storage/');
        // remove image
        Storage::disk('public')->delete($imageName);
        // delete user
        $user->delete();
        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => 'User berhasil dihapus!'
        ]);
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status_code' => 404,
                'status' => false,
                'message' => "ID User tidak ditemukan",
                'data' => []
            ]);
        }

        $payload = [
            'role_id' => 2
        ];

        $user->update($payload);

        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => "User mendapatkan hak akses Admin",
            'data' => $user
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
