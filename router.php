<?php

$url = $_SERVER['REQUEST_URI']; //получаем относительную ссылку
$id = 0;

//массив с путями и их контроллерами, методами и параметрами
$routes = array(
    '#^/users$#' => 'UserController/all',
    '#^/user/([0-9]+)$#' => 'UserController/getById/id',
    '#^/register$#' => 'RegisterController/index',
    '#^/register/user$#' => 'RegisterController/user',
    '#^/register/company$#' => 'RegisterController/company',
    '#^/auth$#' => 'AuthController/index',
    '#^/guests$#' => 'GuestController/all',
    '#^/guest/([0-9]+)$#' => 'GuestController/getById/id',
    '#^/forum$#' => 'ForumController/index',
    '#^/forum/guest$#' => 'ForumController/guest',
    '#^/forum/user$#' => 'ForumController/user',
);

$route = searchRoute($routes, $url);
$data = parseRoute($route, $routes, $url, $id);

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
    foreach($routes as $rout=>$value) {
        if (preg_match($rout, $url, $a)) {
            $result = $value;                               // Получаю класс
            if (isset($a[1])) {
                global $id;
				$id=$a[1];                                  // Получаю ID
            }
        }
    }
	if (!isset($result)) {
            throw new Exception('Путь не найден!');
    }
return $result;                                             // Возвращаю класс ... но ID не вывожу
}

/**
 * Разбирает путь на части
 *
 * @param $route
 * @return array
 */
function parseRoute($route, $routes, $url, $id)
{
    $routeParts = explode('/', $route);
    $data = array(
        'class' => array_shift($routeParts),
        'method' => array_shift($routeParts),
        'params' => $routeParts
    );
	if ($data['params'][0] = 'id') {
		$data['params'][0] = $id;
	}
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