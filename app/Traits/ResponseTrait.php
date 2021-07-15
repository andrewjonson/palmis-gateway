<?php
namespace App\Traits;

trait ResponseTrait
{
    public function successResponse($message, $errorCode)
    {
        return response()->json([
            'type' => 1,
            'message' => $message
        ], $errorCode);
    }

    public function failedResponse($message, $errorCode)
    {
        return response()->json([
            'type' => 2,
            'message' => $message
        ], $errorCode);
    }
}