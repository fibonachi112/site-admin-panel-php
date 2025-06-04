<?php

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config\Config([
    'database'    => [
        'adapter'  => getenv('DB_ADAPTER') ?? 'Postgresql',
        'host'     => getenv('DB_HOST') ?? 'db-postgres',
        'username' => getenv('DB_USERNAME') ??'root',
        'password' => getenv('DB_PASSWORD') ?? 'pass',
        'dbname'   => getenv('DB_NAME') ?? 'shop',
    ],
    'security'    => [
        'jwtExpire'    => 3600,
        'jwtSecret'    => getenv('JWT_SECRET') ?? 'secret',
        'jwtAlgorithm' => getenv('JWT_ALGORITHM') ?? 'HS256'
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
    ]
]);
