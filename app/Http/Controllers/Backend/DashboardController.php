<?php


namespace App\Http\Controllers\Backend;

use App\Http\Responses\BaseResponse;

use App\Http\Controllers\Controller;
use App\Models\User;

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

    public function makeAdmin($id)
    {
        $user = User::find($id);
        if(!$user) {
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
}
