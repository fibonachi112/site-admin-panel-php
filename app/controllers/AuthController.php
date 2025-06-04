<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class AuthController extends Controller
{
    public function loginAction()
    {
        $this->responce->setStatusCode(200,'ok')->setJsonContent([
            'message'=> 'ok'
        ]);
    }
}