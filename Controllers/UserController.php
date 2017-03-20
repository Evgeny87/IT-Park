<?php

class UserController
{
    public function all()
    {
        echo 'Все пользователи';
    }

    public function getById($id)
    {
        echo 'Пользователь c ID '. $id;
    }
}