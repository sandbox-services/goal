<?php

namespace Sandbox\Helpers;

use ArrayAccess;
use ReflectionClass;
use ReflectionParameter;
use Sandbox\Exceptions\MarshalException;

/**
 * Marshal a command from the given array accessible object.
 *
 * @param  string  $command
 * @param  \ArrayAccess  $source
 * @param  array  $extras
 * @return mixed
 */
class Marshal
{
    public static function dispatchFrom($command, ArrayAccess $source, array $extras = [])
    {
        return self::marshal($command, $source, $extras);
    }

    protected static function marshal($command, ArrayAccess $source, array $extras = [])
    {
        $injected = [];

        $reflection = new ReflectionClass($command);

        if ($constructor = $reflection->getConstructor()) {
            $injected = array_map(function ($parameter) use ($command, $source, $extras) {
                return self::getParameterValueForCommand($command, $source, $parameter, $extras);
            }, $constructor->getParameters());
        }

        return $reflection->newInstanceArgs($injected);
    }

    protected static function getParameterValueForCommand($command, ArrayAccess $source, ReflectionParameter $parameter, array $extras = array())
    {
        if (array_key_exists($parameter->name, $extras)) {
            return $extras[$parameter->name];
        }
        if (isset($source[$parameter->name])) {
            return $source[$parameter->name];
        }
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        MarshalException::whileMapping($command, $parameter);
    }
}