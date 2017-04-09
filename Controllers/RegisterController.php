<?php

namespace Controllers;

class RegisterController
{
    public static function index()
    {
        return 'Регистрация';
    }
    public function user()
    {
        return 'Регистрация пользователя';
    }

    public function company()
    {
        return 'Регистрация компании';
    }
}