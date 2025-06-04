<?php

use Phalcon\Mvc\Router\Group;

$router = $di->getRouter();

// Define your routes here

$api = new Group([
    'namespace' => 'App\Controllers',
    'controller'=> 'index',
]);

$api->setPrefix("/api");

$api->AddPost('/login',[
    'controller' => 'Auth',
    'action' => 'login',
]);

$router->mount($api);

$router->handle($_SERVER['REQUEST_URI']);
