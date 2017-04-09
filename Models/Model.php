<?php

namespace Models;


class Model
{
    // Указывает относительный путь к базе
    protected static $table;

    /**
     * Получаем все строки виде массива данных из базы
     *
     * @return array
     */
    public static function all()
    {
        $file = fopen(static::getTable(), 'r');
        $rowCounter = 0;
        $data = array();
        while ($row = fgetcsv($file, null, ';')) {
            $rowCounter++;
            if ($rowCounter <= 1) continue;
            array_push($data, $row);
        }
        return $data;
    }

    /**
     * Получаем одну строку данных по ID
     *
     * @param $id
     * @return array
     */
    public static function getById($id)
    {
        $file = fopen(static::getTable(), 'r');
        $rowCounter = 0;
        while ($row = fgetcsv($file, null, ';')) {
            $rowCounter++;
            if ($rowCounter <= 1) continue;
            if ($row[0] == $id) return $row;
        }
    }

    /**
     * Добавляет префикс к пути
     *
     * @return string
     */
    public static function getTable()
    {
        return 'Tables/' . static::$table;
    }

}