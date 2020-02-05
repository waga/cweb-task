<?php

namespace CWeb;

class Config
{
    /**
     * Singleton instance
     * 
     * @var \CWeb\Config
     */
    protected static $instance;
    
    /**
     * Get instance
     * 
     * @return \CWeb\Config
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    /**
     * Load config
     * 
     * @param mixed $config Config data, could be:
     *   - file path to config
     *   - array of data
     *   - object of data
     * @return \CWeb\Config
     */
    public function load($config)
    {
        switch (gettype($config)) {
            case 'string':
                $this->config = (array) require $config;
                break;
            case 'array':
                $this->config = $config;
                break;
            case 'object':
                $this->config = (array) $config;
                break;
            default:
                break;
        }
        return $this;
    }
    
    /**
     * Set config
     * 
     * @param mixed $key
     * @param mixed $value
     * @return \CWeb\Config
     */
    public function set($key, $value)
    {
        $this->config[$key] = $value;
        return $this;
    }
    
    /**
     * Get config
     * 
     * @param mixed $key Config key 
     *   if key is null all config data is returned
     * @param mixed $defaultReturnValue Default value
     *   used in case if key is not found
     * @return mixed Config data
     */
    public function get($key = null, $defaultReturnValue = null)
    {
        if (null !== $key) {
            if (isset($this->config[$key])) {
                return $this->config[$key];
            }
            return $defaultReturnValue;
        }
        return $this->config;
    }
    
    /**
     * Get config using dot notation key
     * 
     * @param mixed $key Config key
     *   if key is null all config data is returned
     * @param mixed $defaultReturnValue Default value
     *   used in case if key is not found
     * @return mixed Config data
     */
    public function dot($key = null, $defaultReturnValue = null)
    {
        if (null !== $key && strpos($key, '.') !== false) {
            $config = $this->config;
            foreach (explode('.', $key) as $segment) {
                if (!is_array($config) || !isset($config[$segment])) {
                    return $defaultReturnValue;
                }
                $config = $config[$segment];
            }
            return $config;
        }
        return $this->config;
    }
}
