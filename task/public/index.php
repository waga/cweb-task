<?php

require_once '../util.php';

require_once '../lib/Autoloader.php';
\CWeb\Autoloader::create()
    ->register(__DIR__ . DIRECTORY_SEPARATOR .'..', 'Task');

$config = \CWeb\Config::getInstance()
    ->load('../config/config.php');

require_once '../lib/Application.php';
(new \CWeb\Application)
    ->configure($config)
    ->initialize()
    ->dispatch($_SERVER['REQUEST_URI']);
