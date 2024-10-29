<?php

namespace App\Services\DefaultResponse;

class DefaultResponse
{

    public function isSuccess(string $message, int $statusCode)
    {
        return response()->json(['message' => $message, 'statusCode' => $statusCode], $statusCode);
    }
    public function isSuccessWithContent(string $message, int $statusCode, $content)
    {
        return response()->json(['message' => $message, 'statusCode' => $statusCode, 'content' => $content], $statusCode);
    }

}
