<?php
require_once '../config/config.php';
require_once 'Controller.php';
require_once 'Model.php';

spl_autoload_register(function($class) {
    foreach (['../app/controllers/', '../app/models/'] as $dir) {
        if (file_exists($dir . $class . '.php')) {
            require_once $dir . $class . '.php';
            return;
        }
    }
});

$url = explode('/', $_GET['url'] ?? 'movie/search');
$controller = ucfirst($url[0]) . 'Controller';
$method = $url[1] ?? 'search';
$params = array_slice($url, 2);

$instance = new $controller();
call_user_func_array([$instance, $method], $params);
