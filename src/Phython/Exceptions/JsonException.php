<?php

namespace Phython\Exceptions;

use Exception;

class JsonException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $message .= ' - '.json_last_error_msg();
        $code = json_last_error();
        parent::__construct($message, $code, $previous);
    }
}
