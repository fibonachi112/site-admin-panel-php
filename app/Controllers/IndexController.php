<?php
declare(strict_types=1);

namespace App\Controllers;
class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $user = $this->getAuthUser();

        return $this->response->setStatusCode(200, 'ok')->setJsonContent([
            'status'  => 'ok',
            'content' => "test",
        ]);
    }
}

