<?php

class View
{
    /**
     * Подргужает представление и заменяет ключи значениями
     *
     * @param array $data
     * @return mixed|string
     */
    public static function render(array $data)
    {
        ob_start();
        require './Views/home.php';
        $html = ob_get_clean();
        foreach ($data as $key => $value) {
            $html = str_replace('{{' . $key .'}}', $value, $html);
        }
        return $html;
    }
}