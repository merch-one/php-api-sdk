<?php

namespace MerchOne\PhpApiSdk\Exceptions;

use Exception;

class InvalidApiVersionException extends Exception
{
    /**
     * @param  string  $version
     */
    public function __construct(string $version)
    {
        parent::__construct("Invalid API version: {$version}");
    }
}
