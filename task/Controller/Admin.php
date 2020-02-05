<?php

namespace Task\Controller;

use CWeb\Controller;
use Task\Validator\Admin\Login as AdminLoginValidator;

class Admin extends Controller
{
    /**
     * Session user key
     * 
     * @var string
     */
    const SESSION_USER_KEY = 'user';
    
    /**
     * Redirect route on not logged in
     * 
     * @var string
     */
    protected $redirectRouteOnNotLoggedIn = '/admin/login';
    
    /**
     * User success logout route
     * 
     * @var string
     */
    protected $userSuccessLogoutRoute = '/admin';
    
    /**
     * Skip auth check controller method
     * 
     * @var string
     */
    protected $skipAuthCheckControllerMethod = array(
        '\\'. __CLASS__ .'::login',
        '\\'. __CLASS__ .'::logout',
    );
    
    public function __construct()
    {
        parent::__construct();
        $this->authProtection();
    }
    
    /**
     * Auth protection
     * 
     */
    protected function authProtection()
    {
        $route = $this->router->getRoute();
        if ((!$this->session->has(static::SESSION_USER_KEY) || 
            !$this->session->get(static::SESSION_USER_KEY)) && 
            !in_array(
                $route['dispatcher'][0] .'::'. $route['dispatcher'][1], 
                $this->skipAuthCheckControllerMethod)
            )
        {
            $this->redirect($this->redirectRouteOnNotLoggedIn);
            exit;
        }
    }
    
    /**
     * Login
     * 
     */
    public function login()
	{
        if ($_POST) {
            $formValidator = new AdminLoginValidator();
            if (!$formValidator->validate($_POST)) {
                $this->setSessionMessages(
                    $formValidator->getErrors());
            } else {
                $this->session->set(static::SESSION_USER_KEY, array(
                    'username' => $_POST['username']
                ));
            }
            $this->redirect('/admin/');
        }
	}
    
    /**
     * Logout
     * 
     */
    public function logout()
	{
        $this->session->destroy();
        return $this->redirect($this->userSuccessLogoutRoute);
	}
    
    public function getView($method = 'index')
    {
        return 'admin'. DIRECTORY_SEPARATOR . parent::getView($method);
    }
    
    public function getLayout()
    {
        return 'admin'. DIRECTORY_SEPARATOR . parent::getLayout();
    }
}
