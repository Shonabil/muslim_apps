<?php

namespace App\Helpers;

class ResponseHelper

{
    public static function jsonResponseMethod($status = 'success', $message = '', $data = null, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }



    public static function error($message = 'Error', $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}
