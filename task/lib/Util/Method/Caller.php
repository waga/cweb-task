<?php

namespace CWeb\Util\Method;

class Caller
{
    /**
     * Class method caller
     * 
     * @param string $method
     * @param array $arguments
     */
    public static function call($method, array $arguments = array())
    {
        return call_user_func_array($method, $arguments);
    }
}
