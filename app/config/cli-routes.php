<?php

use Phalcon\Autoload\Loader;

$loader = new Loader();

$loader->setNamespaces([
    'App\\tasks' => realpath(__DIR__.'/../tasks'),
])->register();;

