<?php

namespace App\Tasks;

use Phalcon\Cli\Task;

/**
 * таска по работе с пользователями
 */
class UsersTask extends Task
{
    public function addAction(array $params)
    {
        echo "Создание пользователя...\n";
        var_dump($params);
    }
}