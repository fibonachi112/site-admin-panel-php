<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    /**
     * @return Users
     */
    protected function getAuthUser()
    {
        return $this->di->getShared('auth_user');
    }
}
