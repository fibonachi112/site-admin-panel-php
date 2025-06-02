<?php

use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class IndexController extends Controller {
    public function indexAction() {
        echo "<h1>Hello from Phalcon</h1>";
    }
}

$di = new FactoryDefault();

$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    }
);

$app = new Application($di);

$app->handle($_SERVER["REQUEST_URI"])->send();
