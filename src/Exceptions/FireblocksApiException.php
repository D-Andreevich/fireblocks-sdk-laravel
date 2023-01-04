<?php

namespace FireblocksSDK\Exceptions;

use Exception;

class FireblocksApiException extends Exception
{
    /**
     * Exception raised for Fireblocks sdk errors
     * @param string $message explanation of the error
     * @param $error_code //code of the error
     */
    public function __construct(string $message = "Fireblocks SDK error", $error_code=null)
    {
        $this->message = $message;
        $this->code = $error_code;
        parent::__construct($message);
    }
}