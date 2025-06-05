<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function getAuthUser()
    {
        return $this->di->getShared('auth_user');
    }
}
