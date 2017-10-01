<?php
namespace common\enums;

abstract class Enum
{
    static function getValue($key, $list = null, $default = "N/A")
    {
        $list = $list ?: static::getList();
        if (!array_key_exists($key, $list))
            return $default;

        return $list[$key];
    }

    static function getName($key, $default = "N/A")
    {
        $list = static::getList();
        if (!array_key_exists($key, $list))
            return $default;

        return $list[$key];
    }

    public static function hasValue($value)
    {
        return in_array($value, static::getValues());
    }

    public static function getKeys($list = null)
    {
        return array_keys($list ?: static::getList());
    }

    public static function getValues($list = null)
    {
        return array_keys($list ?: static::getList());
    }

    public static function getList()
    {
        $class = get_called_class();
        $oClass = new \ReflectionClass($class);
        $constants = $oClass->getConstants();
        return array_combine(array_values($constants), array_keys($constants));
    }

    public static function hasKey($key, $list = null)
    {
        return in_array($key, static::getKeys($list) );
    }


    public static function getRandKey($list = null)
    {
        return array_rand($list ?: static::getList());
    }

}
