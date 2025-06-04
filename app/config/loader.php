<?php

$loader = new \Phalcon\Autoload\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->setNamespaces([
    'App\\Controllers' => $config->application->controllersDir,
    'App\\Models'      => $config->application->modelsDir,
])->register();;


