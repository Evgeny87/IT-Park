<?php

namespace Controllers;

use Models\User;

class UserController
{
    public function all()
    {
        $users = User::all();
        return 'Все пользователи. Количество пользователей: '. count($users);
    }

    public function getById($id)
    {
        $user = User::getById($id);
        return 'Пользователь c ID '. $user[0] . ' ' . $user[1];
    }
}