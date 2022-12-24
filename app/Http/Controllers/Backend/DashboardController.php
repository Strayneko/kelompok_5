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

    // TODO: make user to admin
    public function addAdmin()
    {
    }
}
