<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Dotenv\Dotenv;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    require dirname(__DIR__) . '/vendor/autoload.php';

    $dotenv = Dotenv::createImmutable(BASE_PATH);

    $dotenv->load();

    foreach ($_ENV as $key => $value) {
        putenv("$key=$value");
    }

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . '/Config/services.php';

    /**
     * Handle routes
     */
    include APP_PATH . '/Config/router.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
