<?php

namespace CWeb;

class View
{
    /**
     * View base path
     * 
     * @var string
     */
    protected $basePath;
    
    /**
     * Set base path
     * 
     * @param string $basePath Base path for views
     * @return \CWeb\View
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }
    
    /**
     * Render view
     * 
     * @param string $view View to render
     * @param array $data Data to pass to view
     * @return string Rendered content
     */
    public function render($view, array $data = array())
    {
        extract($data);
        ob_start();
        include $this->basePath . $view .'.php';
        return ob_get_clean();
    }
}
