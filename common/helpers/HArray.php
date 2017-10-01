<?php

namespace common\helpers;

/**
 * Класс для доп.методов работы с массивами
 *
 * @package common\helpers
 */
class HArray
{
    /**
     * Метод для добавления в массив уникального элемента
     *
     * @param array $arr Указатель на массив, в который добавляется уникальный элемент
     * @param string $item Элемент, который нужно добавить, если такого еще нет в массике $arr. Если задано $value, то $item - ключ
     * @param null $value
     */
    public static function addUniqueItem(&$arr, $item, $value = null)
    {
        if (is_null($item))
            return;

        if (is_null($value) && !in_array($item, $arr))
            $arr[] = $item;
        elseif (!is_null($value) && !array_key_exists($item, $arr))
            $arr[$item] = $value;
    }

}

?>