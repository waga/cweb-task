<?php

namespace CWeb;

use CWeb\Session;
use CWeb\Router;

class Controller
{
    /**
     * Session messages key
     * 
     * @var string
     */
    const SESSION_MESSAGES_KEY = 'messages';
    
    /**
     * Message type warning
     * 
     * @var string
     */
    const MESSAGE_TYPE_WARNING = 'warning';
    
    /**
     * Default message type
     * 
     * @var string
     */
    const DEFAULT_MESSAGE_TYPE = self::MESSAGE_TYPE_WARNING;
    
    /**
     * Default layout
     * 
     * @var string
     */
    const DEFAULT_LAYOUT = 'layout/default';
    
    /**
     * View
     * 
     * @var mixed
     */
    protected $view = true;
    
    /**
     * Layout
     * 
     * @var mixed
     */
    protected $layout = true;
    
    /**
     * Config
     * 
     * @var \CWeb\Config
     */
    protected $config;
    
    /**
     * Session
     * 
     * @var \CWeb\Session
     */
    protected $session;
    
    /**
     * Router
     * 
     * @var \CWeb\Router
     */
    protected $router;
    
    /**
     * Database
     * 
     * @var \CWeb\Database
     */
    protected $database;
    
    /**
     * Class constructor
     * 
     */
    public function __construct()
    {
        $this->config = Config::getInstance();
        $this->session = Session::getInstance()->start();
        $this->router = Router::getInstance();
        $this->database = Database::getInstance()
            ->connect($this->config->dot('database.host'), 
                $this->config->dot('database.user'), 
                $this->config->dot('database.pass'), 
                $this->config->dot('database.database'), 
                $this->config->dot('database.port'));
    }
    
    /**
     * Get session message
     * 
     * @param string $type
     * @return array
     */
    public function getSessionMessages(
        $type = self::DEFAULT_MESSAGE_TYPE)
    {
        $messages = array();
        
        if ($this->session->has(static::SESSION_MESSAGES_KEY)) {
            $messages = $this->session->get(static::SESSION_MESSAGES_KEY);
        }
        
        if (!is_array($messages)) {
            $messages = array();
        }
        
        if (null === $type) {
            $this->session->set(static::SESSION_MESSAGES_KEY, array());
            return $messages;
        }
        
        if (!$type || !is_string($type)) {
            $type = static::DEFAULT_MESSAGE_TYPE;
        }
        
        $result = array();
        
        if (array_key_exists($type, $messages)) {
            $result = $messages[$type];
            unset($messages[$type]);
        }
        
        $this->session->set(static::SESSION_MESSAGES_KEY, $messages);
        return $result;
    }
    
    /**
     * Set session message
     * 
     * @param string $message
     * @param string $type
     */
    public function setSessionMessage($message, 
        $type = self::DEFAULT_MESSAGE_TYPE)
    {
        $messages = array();
        
        if ($this->session->has(static::SESSION_MESSAGES_KEY)) {
            $messages = $this->session->get(static::SESSION_MESSAGES_KEY);
        }
        
        if (!is_array($messages)) {
            $messages = array();
        }
        
        if (!$type || !is_string($type)) {
            $type = static::DEFAULT_MESSAGE_TYPE;
        }
        
        if (!array_key_exists($type, $messages)) {
            $messages[$type] = array();
        }
        
        $messages[$type][] = $message;
        $this->session->set(static::SESSION_MESSAGES_KEY, $messages);
        return $this;
    }
    
    /**
     * Set session messages
     * 
     * @param array $messages
     * @return \CWeb\Controller
     */
    public function setSessionMessages(array $messages)
    {
        foreach ($messages as $type => $message) {
            $this->setSessionMessage($message, $type);
        }
        return $this;
    }
    
    /**
     * Get view
     * 
     * @param string $method
     * @return string|null
     */
    public function getView($method = 'index')
    {
        if (false === $this->view || null === $this->view) {
            return;
        }
        
        if (true === $this->view) {
            $segments = explode('\\', get_called_class());
            $view = end($segments);
            $view = strtolower($view);
            $method = strtolower($method);
            return $view . DIRECTORY_SEPARATOR . $method;
        }
        
        return $this->view;
    }
    
    /**
     * Get layout
     * 
     * @return string|null
     */
    public function getLayout()
    {
        if (false === $this->layout || null === $this->layout) {
            return;
        }
        
        if (true === $this->layout) {
            return static::DEFAULT_LAYOUT;
        }
        
        return $this->layout;
    }
    
    /**
     * Redirect
     * 
     */
    protected function redirect($url)
    {
        header('Location: http://'. $_SERVER['HTTP_HOST'] . $url);
        exit;
    }
}
