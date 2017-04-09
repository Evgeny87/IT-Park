<?php

namespace Controllers;

class ForumController
{
    public function index()
    {
        return 'Форум - Вы сюда попали первый раз?';
    }
    public function user()
    {
        return 'Форум для пользователей';
    }

    public function guest()
    {
        return 'Форум для гостей';
    }
}