<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.04.2017
 * Time: 18:45
 */
namespace Helpers;
class JSON
{
    /**
     * ������������ ������ � JSON ������
     *
     * @param $data
     * @return string
     */
    public static function toJson($data)
    {
        return json_encode($data);
    }
    /**
     * ������������ JSON ������ � ������ ��� ������
     *
     * @param $json
     * @return object|array
     */
    public static function fromJson($json, $asArray = false)
    {
        return json_decode($json, $asArray);
    }
}