<?php

namespace App\Tasks;

use Phalcon\Cli\Task;

class UsersTask extends Task
{
    public function addUser(array $params)
    {
        var_dump($params);
    }
}