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
        // return error response message
        if ($user->role_id == 2) return response()->json([
            'status_code' => 400,
            'status' => false,
            'message' => "User sudah menjadi admin",
        ]);

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
}
