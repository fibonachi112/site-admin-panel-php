<?php

declare(strict_types=1);

require_once __DIR__ . './../vendor/autoload.php';

$di = new \Phalcon\Di\FactoryDefault\Cli();

require realpath(__DIR__ . "/../app/config/cli-routes.php");
require realpath(__DIR__ . '/../app/config/services.php');

$console = new \Phalcon\Cli\Console();
$console->setDI($di);

try {
    $args = [
        'task'   => $argv[1] ?? null,
        'action' => $argv[2] ?? null,
        'params' => array_slice($argv, 3)
    ];
    $console->handle($args);
} catch (\Throwable $e) {
    echo "Error : ", $e->getMessage(), PHP_EOL;
    exit(1);
}
