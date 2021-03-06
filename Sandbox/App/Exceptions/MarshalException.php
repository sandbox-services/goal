<?php

namespace Sandbox\Exceptions;

use RuntimeException;
use ReflectionParameter;

class MarshalException extends RuntimeException
{
    /**
     * Throw a new exception.
     *
     * @param  string  $command
     * @param  \ReflectionParameter  $parameter
     * @return void
     *
     * @throws static
     */
    public static function whileMapping($command, ReflectionParameter $parameter)
    {
        throw new static("Unable to map parameter [{$parameter->name}] to command [{$command}]");
    }
}