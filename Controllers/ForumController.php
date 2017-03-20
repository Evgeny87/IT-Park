<?php

class ForumController
{
    public function index()
    {
        echo 'Форум - Вы сюда попали первый раз?';
    }
    public function user()
    {
        echo 'Форум для пользователей';
    }

    public function guest()
    {
        echo 'Форум для гостей';
    }
}