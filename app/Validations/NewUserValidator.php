<?php

namespace App\Validations;

use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;

class NewUserValidator extends Validation
{
    public function initialize()
    {
        $this->add("email", new PresenceOf([
            'message' => 'email обязателен',
        ]));

        $this->add('email', new Email([
            'message' => 'email не верен'
        ]));

        $this->add('password', new PresenceOf([
            'message' => 'password обязателен',
        ]));
        $this->add('password', new StringLength([
            'min' => 10,
            'messageMinimum' => 'Пароль должен быть 10 символов'
        ]));
    }
}