<?php
declare(strict_types=1);

class AuthController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $this->responce->setStatusCode(200,'ok')->setJsonContent([
            'message'=> 'ok'
        ]);
    }
}

