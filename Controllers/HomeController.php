<?php

namespace Controllers;

use Models\User;

class HomeController
{
    public function index()
    {
        $user = User::getById(1);
        return \View::render($user);
    }
}