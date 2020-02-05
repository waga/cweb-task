<?php

return array(
    'database' => array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'database' => 'cweb_task',
        'port' => 3306,
    ),
    'router' => array(
        'not_found' => array(
            'dispatcher' => array('\Task\Controller\Error', 'notFound')
        ),
        'routes' => array(
            array(
                'url' => '/', 
                'dispatcher' => array('\Task\Controller\Home', 'index'), 
            ),
            array(
                'url' => '/form', 
                'dispatcher' => array('\Task\Controller\Form', 'index'), 
            ),
            array(
                'url' => '/admin', 
                'dispatcher' => array('\Task\Controller\Admin\Home', 'index'), 
            ),
            array(
                'url' => '/admin/login', 
                'dispatcher' => array('\Task\Controller\Admin', 'login'), 
            ),
            array(
                'url' => '/admin/logout', 
                'dispatcher' => array('\Task\Controller\Admin', 'logout'), 
            ),
            array(
                'url' => '/admin/user/list', 
                'dispatcher' => array('\Task\Controller\Admin\User', 'list'), 
            )
        )
    ),
    'view' => array(
        'dir' => '../View/'
    )
);
