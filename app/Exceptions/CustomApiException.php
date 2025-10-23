<?php

namespace App\Exceptions;

use Exception;

use Throwable;
use Illuminate\Http\JsonResponse;

class CustomApiException extends Exception
{
    protected $code;
    protected $message;
    protected $errors;

    public function __construct(string $message = "", int $code = 0, array $errors = [], Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
        $this->code = $code;
        $this->errors = $errors;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->message,
            'errors' => $this->errors,
        ], $this->code);
    }
}
