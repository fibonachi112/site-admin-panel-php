<?php

class JwtAuthMiddleware extends \Phalcon\Di\Injectable
{
    public function beforeExecuteRoute(\Phalcon\Events\Event $event, \Phalcon\Mvc\Dispatcher $dispatcher): bool
    {
        $authHeader = $this->request->getHeader('Authorisation');

        if (!$authHeader || !str_starts_with("Bearer: ", $authHeader)) {
            return $this->unauthorized('Missing bearer token');
        }

        $token = trim(str_replace("Bearer: ", "", $authHeader));

        try {
            $decoded = \Firebase\JWT\JWT::decode($token);
            $user    = \App\Models\Users::findFirst(['id' => $decoded->id]);

            if (!$user) {
                return $this->unauthorized("userNotFound");
            }

            $this->di->setShared('auth_user', $user);

        } catch (\Throwable $e) {
            return $this->unauthorized('invalid token');
        }

        return true;
    }

    protected function unauthorized(string $message): bool
    {
        $this->response->setStatusCode(401, 'Unauthorized')->setJsonContent([
            'status'  => 'error',
            'message' => $message
        ])->send();

        return false;
    }

}