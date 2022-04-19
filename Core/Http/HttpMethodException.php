<?php

namespace Core\Http;

use Exception;
use Throwable;

class HttpMethodException extends Exception
{

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("HTTP Method: $message", $code, $previous);
    }
}