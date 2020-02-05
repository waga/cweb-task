<?php

namespace CWeb;

class Session
{
    /**
     * Singleton instance
     * 
     * @var \CWeb\Session
     */
    protected static $instance;
    
    /**
     * Get instance
     * 
     * @return \CWeb\Session
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    /**
     * Start session
     * 
     * @return \CWeb\Session
     */
    public function start()
    {
        session_start();
        return $this;
    }
    
    /**
     * Check session key exists
     * 
     * @return bool
     */
    public function has($key)
    {
        return isset($_SESSION[$key]);
    }
    
    /**
     * Get session by key
     * 
     * @param string $key
     * @param mixed $defaultReturnValue
     * @return mixed
     */
    public function get($key, $defaultReturnValue = null)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        return $defaultReturnValue;
    }
    
    /**
     * Set session by key
     * 
     * @param string $key
     * @param mixed $value
     * @return \CWeb\Session
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }
    
    /**
     * Destroy session
     * 
     * @return \CWeb\Session
     */
    public function destroy()
    {
        session_destroy();
        return $this;
    }
}
