<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Responses\BaseResponse;
use App\Models\User;

class DashboardController extends Controller
{
    // TODO: show users list
    public function index(BaseResponse $response)
    {
        $users =  User::query()->orderBy('role_id')->get();
        return $response->success($users);
    }

    // TODO: make user to admin
    public function addAdmin()
    {
    }
}
