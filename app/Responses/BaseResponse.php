<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;

class BaseResponse extends Response
{
    // base  success response
    public static function success($data = [],  string $message = 'Data successfully fetched!', int $status_code = 200)
    {
        return response()->json([
            'status_code' => 200,
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $status_code);
    }


    // base error response
    public static function error(string | array $message = '', int $status_code = 400)
    {
        return response()->json([
            'status_code' => $status_code,
            'status' => false,
            'message' => $message
        ], $status_code);
    }
}
