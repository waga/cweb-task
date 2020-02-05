<?php

namespace CWeb;

class Autoloader
{
    /**
     * Loaders
     * 
     * @var array
     */
    protected $loaders = array();
    
    /**
     * Class constructor
     * 
     * @param bool $autoRegister Flag to 
     *  automatically register current namespace
     */
    public function __construct($autoRegister = true)
    {
        if ($autoRegister) {
            $this->register(dirname(__FILE__));
        }
    }
    
    /**
     * Factory 
     * 
     * @return \CWeb\Autoloader
     */
    public static function create()
    {
        return new static();
    }
    
    /**
     * Register namespace
     * 
     * @param string $path
     * @param string $namespace
     * @return \CWeb\Autoloader
     */
    public function register($path, $namespace = __NAMESPACE__)
    {
        $this->loaders[$namespace] = rtrim($path, '\/');
        spl_autoload_register(array($this, 'loadClass'));
        return $this;
    }
    
    /**
     * Load class
     * 
     * @param string $class
     * @return \CWeb\Autoloader
     */
    public function loadClass($class)
    {
        $className = ltrim($class, '\\');
        if ($lastNamespacePosition = strpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNamespacePosition);
            $className = substr($className, $lastNamespacePosition + 1);
            include $this->loaders[$namespace] . 
                DIRECTORY_SEPARATOR . 
                str_replace('\\', DIRECTORY_SEPARATOR, $className) .'.php';
        }
        return $this;
    }
}
