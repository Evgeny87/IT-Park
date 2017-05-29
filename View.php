<?php

class View
{
    /**
     * Подргужает представление и заменяет ключи значениями
     *
     * @param array $data
     * @param string $template
     * @return mixed|string
     */
    public static function render($template = 'errors/404.php', $data = null)
    {
        if ($data && is_array($data)) extract($data);
        ob_start();
            require './Views/'. $template . '.php';
        $html = ob_get_clean();
        return $html;
    }
}