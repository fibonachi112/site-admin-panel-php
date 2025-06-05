<?php

namespace App\Middleware;

use Firebase\JWT\Key;
use Phalcon\Config\Config;

class JwtAuthMiddleware extends \Phalcon\Di\Injectable
{
    public function beforeExecuteRoute(\Phalcon\Events\Event $event, \Phalcon\Mvc\Dispatcher $dispatcher): bool
    {
        $route = $dispatcher->getControllerName();

        if (in_array($route, ['auth'])) {
            return true; // эти контроллеры не требуют авторизации
        }

        $authHeader = $this->request->getHeader('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, "Bearer")) {
            $this->unauthorized('Missing bearer token');
        }

        /** @var Config $config */
        $config = $this->config;

        $token   = trim(str_replace("Bearer", "", $authHeader));
        $jwtKey  = new Key($config->security->jwtSecret, $config->security->jwtAlgorithm);
        $decoded = \Firebase\JWT\JWT::decode($token, $jwtKey);

        try {
            $user = \App\Models\Users::findFirst(['id' => $decoded->id]);

            if (!$user) {
                $this->unauthorized("userNotFound");
            }

            $this->di->setShared('auth_user', $user);

        } catch (\Throwable $e) {
            $this->unauthorized('invalid token');
        }

        return true;
    }

    protected function unauthorized(string $message)
    {
        $this->response->setContentType('application/json', 'utf-8')->setStatusCode(401, 'Unauthorized')->setJsonContent([
            'status'  => 'error',
            'message' => $message
        ])->send();

        exit;
    }
}