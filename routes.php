<?php


//массив с путями и их контроллерами, методами и параметрами
return array(
    '/users' => 'UserController/all',
    '/user/:num' => 'UserController/getById/id',
    '/register' => 'RegisterController/index',
    '/register/user' => 'RegisterController/user',
    '/register/company' => 'RegisterController/company',
    '/auth' => 'AuthController/index',
    '/guests' => 'GuestController/all',
    '/guest/:num' => 'GuestController/getById/id',
    '/forum' => 'ForumController/index',
    '/forum/guest' => 'ForumController/guest',
    '/forum/user' => 'ForumController/user',
    '/' => 'HomeController/index',
);
