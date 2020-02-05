<?php

namespace CWeb\Util\Klass;

use ReflectionClass;

class Creator
{
    /**
     * Class instance creator
     * 
     * @param string $class Class name
     * @param array $arguments Constructor arguments
     */
    public static function createInstance($class, 
        array $arguments = array())
    {
        $reflection = new ReflectionClass($class);
        return $reflection->newInstanceArgs($arguments);
    }
}
