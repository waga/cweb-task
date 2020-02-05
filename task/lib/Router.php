<?php

namespace CWeb;

use Exception;

class Router
{
    /**
     * Singleton instance
     * 
     * @var \CWeb\Session
     */
    protected static $instance;
    
    /**
     * Routes
     * 
     * @var array
     */
    protected $routes = array();
    
    /**
     * Found route
     * 
     * @var array
     */
    protected $route = array();
    
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
     * Set routes
     * 
     * @param array $routes
     * @return \CWeb\Router
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
        return $this;
    }
    
    /**
     * Route by given uri
     * 
     * @param string $uri
     * @return array Found route
     */
    public function route($uri)
    {
        foreach ($this->routes as $route) {
            if ($route['url'] == $uri) {
                $this->route = $route;
                return $route;
            }
        }
        return array();
    }
    
    /**
     * Get found route
     * 
     * @return array Found route
     */
    public function getRoute()
    {
        return $this->route;
    }
}
