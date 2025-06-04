<?php

namespace App\Tasks;

use App\Models\Users;
use App\Validations\NewUserValidator;
use Phalcon\Cli\Task;

/**
 * таска по работе с пользователями
 */
class UsersTask extends Task
{
    public function addAction(array $params)
    {
        $validator = new NewUserValidator();

        [$email, $password] = $params + [null, null];

        $messages = $validator->validate([
            'email'    => $email,
            'password' => $password
        ]);

        if (count($messages) > 0) {
            foreach ($messages as $message) {
                echo $message . PHP_EOL;
            }
            return;
        }

        $user = new Users();

        $user->setEmail($email);
        $user->setPasswordHash($this->security->hash($password));

        if (!$user->create()) {
            foreach ($user->getMessages() as $message) {
                echo $message . PHP_EOL;
            }
        }

        echo "Создание пользователя...\n";
    }
}