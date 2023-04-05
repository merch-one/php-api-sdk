<?php

namespace MerchOne\PhpApiSdk\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionClass;
use ReflectionException;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param  object  $object
     * @param  string  $property
     * @return string|int|float|bool|array|object|null
     *
     * @throws ReflectionException
     */
    protected function getObjectProperty(object $object, string $property)
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    /**
     * @param  object  $object
     * @param  string  $method
     * @param  array  $arguments
     * @return string|int|float|bool|array|object|null
     *
     * @throws ReflectionException
     */
    protected function callObjectMethod(object $object, string $method, array $arguments = [])
    {
        $reflection = new ReflectionClass($object);
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invoke($object, ...$arguments);
    }

    /**
     * @param  object  $object
     * @param  string  $property
     * @param $value
     * @return void
     *
     * @throws ReflectionException
     */
    protected function setObjectProperty(object $object, string $property, $value): void
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
}
