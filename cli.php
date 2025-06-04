<?php

use Dotenv\Dotenv;
use Phalcon\Autoload\Loader;
use Phalcon\Cli\Console;
use Phalcon\Cli\Console\Exception as PhalconException;
use Phalcon\Cli\Dispatcher;
use Phalcon\Di\FactoryDefault\Cli as CliDI;

error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(BASE_PATH);

$dotenv->load();

foreach ($_ENV as $key => $value) {
    putenv("$key=$value");
}

$loader = new Loader();
$loader->setNamespaces([
    'App' => 'app/',
]);
$loader->register();

$di         = new CliDI();
$dispatcher = new Dispatcher();

$dispatcher->setDefaultNamespace('App\Tasks');
$di->setShared('dispatcher', $dispatcher);
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class  = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    return new $class($params);
});

$di->setShared('config', function () {
    return include 'app/Config/config.php';
});

$console = new Console($di);

$arguments = [];
foreach ($argv as $k => $arg) {
    if ($k === 1) {
        $arguments['task'] = $arg;
    } elseif ($k === 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = array_slice($argv, 3);
    }
}


try {
    $console->handle($arguments);
} catch (PhalconException $e) {
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
} catch (\Throwable $throwable) {
    fwrite(STDERR, $throwable->getMessage() . PHP_EOL);
    exit(1);
} catch (\Exception $exception) {
    fwrite(STDERR, $exception->getMessage() . PHP_EOL);
    exit(1);
}