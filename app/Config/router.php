<?php

use Phalcon\Mvc\Router\Group;

$router = $di->getRouter();

$api = new Group([
    'namespace' => 'App\Controllers',
]);

$api->setPrefix('/api');

$api->addPost('/login', [
    'controller' => 'auth',
    'action'     => 'login',
]);

$api->addGet('/pages/index', [
    'controller' => 'index',
    'action'     => 'index',
]);

$router->mount($api);

return $router;
