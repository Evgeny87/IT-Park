<?php
// require_once "Controllers/YouTubeController.php";

 function loadFromClasses($aClassName) {
    $aClassFilePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $aClassName . '.php';
    if (file_exists($aClassFilePath)) {
        require_once $aClassFilePath;
        return true;
    }
    return false;
}


//регистрируем обе функции автозагрузки
spl_autoload_register('loadFromClasses');
$url = $_SERVER['REQUEST_URI'];

$parts = explode("?",$url);
$url = $parts[0];
$routes = include './routes.php';


$route = searchRoute($routes, $url);
$data = parseRoute($route);

if($data["class"] == "") {
    $data['class'] = "YouTubeController";
    $data['method'] = "error404";
    $data['params'] = array();
}


return call($data['class'], $data['method'], $data['params']);

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
    $data = array();
    foreach ($routes as $key => $value) {
        $key = str_replace(':num', '([\d]+)', $key);
        if (preg_match('{^'. $key .'$}', $url, $matches)) {
            array_shift($matches);
            $data['route'] = $key;
            $data['uses'] = $value;
            $data['params'] = $matches;
            return $data;
        }
    }
}

/**
 * Разбирает путь на части
 *
 * @param $route
 * @return array
 */
function parseRoute($route)
{
    $routeParts = explode('/', $route['uses']);

    $data = array(
        'class' => array_shift($routeParts),
        'method' => array_shift($routeParts),
        'params' => $route['params']
    );
    return $data;
}

/**
 * Вызывает метод в указанном классе с параметрами
 *
 * @param $className
 * @param $methodName
 * @param $params
 * @return mixed
 */

function call($className, $methodName, $params)
{
#    $controller = new $className();
#    return $controller->$methodName();
    return call_user_func_array(['Controllers\\' . $className, $methodName], $params);
}