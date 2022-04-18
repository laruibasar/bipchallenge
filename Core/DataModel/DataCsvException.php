<?php

namespace Core\DataModel;

use Exception;
use Throwable;

class DataCsvException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('CSV data load: ' . $message, $code, $previous);
    }
}