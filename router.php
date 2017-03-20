<?php

$url = $_SERVER['REQUEST_URI']; //получаем относительную ссылку

//массив с путями и их контроллерами, методами и параметрами
$routes = array(
    '/users' => 'UserController/all',
    '/user/1' => 'UserController/getById/1',
    '/register' => 'RegisterController/index',
    '/register/user' => 'RegisterController/user',
    '/register/company' => 'RegisterController/company',
    '/auth' => 'AuthController/index',
);

$route = searchRoute($routes, $url);
$data = parseRoute($route);

call($data['class'], $data['method'], $data['params']);


/**
 * Ищет ссылку в массиве
 *
 * @param $routes
 * @param $url
 * @return mixed
 * @throws Exception
 */
function searchRoute($routes, $url)
{
    if (isset($routes[$url])) {
        $result = $routes[$url];
    } else {
        throw new Exception('Путь не найден!');
    }
    return $result;
}

/**
 * Разбирает путь на части
 *
 * @param $route
 * @return array
 */
function parseRoute($route)
{
    $routeParts = explode('/', $route);

    $data = array(
        'class' => array_shift($routeParts),
        'method' => array_shift($routeParts),
        'params' => $routeParts
    );
    return $data;
}

/**
 * Вызывает метод в указанном классе с параметрами
 *
 * @param $className
 * @param $methodName
 * @param $params
 */
function call($className, $methodName, $params)
{
    call_user_func_array([$className, $methodName], $params);
}