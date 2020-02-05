<?php

namespace CWeb;

use Exception;
use ErrorException;
use CWeb\View;
use CWeb\Config;
use CWeb\Util\Klass\Creator as ClassCreatorUtil;
use CWeb\Util\Method\Caller as MethodCallerUtil;
use Task\Controller\Admin as AdminController;

class Application
{
    /**
     * Config
     * 
     * @var \CWeb\Config
     */
    protected $config;
    
    /**
     * Configure application
     * 
     * @param \CWeb\Config $config
     * @return \CWeb\Application
     */
    public function configure(Config $config)
    {
        $this->config = $config;
        
        if (!$this->config->dot('error.handler')) {
            $this->config->set('error', array(
                'handler' => function($level, $message, $file, $line) {
                    if (error_reporting() !== 0) {
                        throw new ErrorException(
                            $message, 0, $level, $file, $line);
                    }
                }
            ));
        }
        
        if (!$this->config->dot('exception.handler')) {
            $this->config->set('exception', array(
                'handler' => function($exception) {
                    echo '<pre>'. print_r($exception, true) .'</pre>'. PHP_EOL;
                }
            ));
        }
        
        return $this;
    }
    
    /**
     * Initialize application
     * 
     * @return \CWeb\Application
     */
    public function initialize()
    {
        error_reporting(E_ALL);
        set_error_handler($this->config->dot('error.handler'));
        set_exception_handler($this->config->dot('exception.handler'));
        setlocale(LC_ALL, NULL);
        return $this;
    }
    
    /**
     * Dispatch application
     * 
     * @param string $uri
     */
    public function dispatch($uri)
    {
        $route = Router::getInstance()
            ->setRoutes($this->config->dot('router.routes'))
            ->route($uri);
        
        if (!$route) {
            $route = $this->config->dot('router.not_found');
        }
        
        if (2 != count($route['dispatcher']) || 
            !class_exists($route['dispatcher'][0])) {
            throw new Exception('Invalid dispatcher!');
        }
        
        $dispatcherInstance = ClassCreatorUtil::createInstance(
            $route['dispatcher'][0]);
        
        if (!$dispatcherInstance) {
            throw new Exception('Invalid dispatcher instance!');
        }
        
        $actionResponse = MethodCallerUtil::call(array(
            $dispatcherInstance, 
            $route['dispatcher'][1]
        ));
        
        if (!$actionResponse) {
            $actionResponse = array();
        }
        
        $actionResponse = $actionResponse + array(
            'user' => Session::getInstance()->get(AdminController::SESSION_USER_KEY),
            'messages' => $dispatcherInstance->getSessionMessages(null)
        );
        
        $dispatcherView = $dispatcherInstance->getView($route['dispatcher'][1]);
        $dispatcherLayout = $dispatcherInstance->getLayout();
        
        if ($dispatcherView) {
            $view = new View();
            $view->setBasePath($this->config->dot('view.dir'));
            if ($dispatcherLayout) {
                $renderedView = $view->render($dispatcherLayout, $actionResponse + array(
                    'content' => $view->render($dispatcherView, 
                        $actionResponse)
                ));
            } else {
                $renderedView = $view->render($dispatcherView, 
                    $actionResponse);
            }
            echo $renderedView;
        }
    }
}
