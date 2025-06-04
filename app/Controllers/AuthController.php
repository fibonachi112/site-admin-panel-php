<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;
use Firebase\JWT\JWT;
use Phalcon\Mvc\Controller;


class AuthController extends Controller
{
    public function loginAction()
    {
        $data     = $this->request->getJsonRawBody(true);
        $email    = trim($data['email'] ?? "");
        $password = $data['password'] ?? "";

        /** @var \Phalcon\Config\Config $config */
        $config = $this->config;

        if (!$email || !$password) {
            return $this->response->setStatusCode(422, "Unprocessable Entity")->setJsonContent([
                'status'  => 'error',
                "message" => 'Email and Password required'
            ]);
        }

        $user = Users::findFirst(['email' => $email]);

        if (!$user || !$this->security->checkHash($password, $user->getPasswordHash())) {
            return $this->response->setStatusCode(422, "Unprocessable Entity")->setJsonContent([
                'status'  => 'error',
                "message" => 'Email or Password incorrect'
            ]);
        }

        $payload = [
            'id'    => $user->getId(),
            'email' => $user->getEmail(),
            'iat'   => time(),
            'exp'   => time() + $config->security->jwtExpire
        ];

        $jwt = JWT::encode($payload, $config->security->jwtSecret, $config->security->jwtAlgorithm);

        return $this->response->setStatusCode(200, 'ok')->setJsonContent([
            'status' => 'ok',
            'jwt'    => $jwt
        ]);
    }
}