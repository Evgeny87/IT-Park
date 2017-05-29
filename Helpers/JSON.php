<?php

namespace Helpers;

class JSON
{
    /**
     * Конвертирует данные в JSON строку
     *
     * @param $data
     * @return string
     */
    public static function toJson($data)
    {
        return json_encode($data);
    }

    /**
     * Конвертирует JSON строку в объект или массив
     *
     * @param $json
     * @return object|array
     */
    public static function fromJson($json, $asArray = false)
    {
        return json_decode($json, $asArray);
    }
}