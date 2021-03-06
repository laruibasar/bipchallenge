<?php

namespace Core\Route;

use Exception;
use Throwable;

class RouteNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("Routing: $message", $code, $previous);
    }
}