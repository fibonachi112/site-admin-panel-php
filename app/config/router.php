<?php

use Phalcon\Mvc\Router\Group;

$router = $di->getRouter();

$api = new Group([
    'namespace' => 'App\Controllers',
    'controller'=> 'Auth',
]);

$api->setPrefix("/api");

$api->AddPost('/login',[
    'controller' => 'Auth',
    'action' => 'login',
]);

$router->mount($api);

$router->handle($_SERVER['REQUEST_URI']);
