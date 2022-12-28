<?php

namespace App\Traits;

trait ApiResponse
{

    protected function success(string $message = null, $data = null, int $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function fail(string $message = null, $data = null, int $code)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}