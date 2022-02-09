<?php
namespace App\Traits\API;

trait RespondsWithHttpStatus
{
    /**
     * Return success response with o
     */
    protected function success($message, $data = [], $token = null, $status = 200)
    {
        if (is_null($token)) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $status);
        } else {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
                "token" => $token,
                "token_type" => "bearer",
            ], $status);
        }
    }

    protected function failure($message, $error, $status = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $error
        ], $status);
    }
}
