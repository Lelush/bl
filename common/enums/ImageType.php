<?php

namespace common\enums;


use yii\helpers\ArrayHelper;

class ImageType extends Enum
{
    const USER = 'user';
    const COMPANY = 'company';

    public static $config = [
        self::USER => [
            'slice' => true,
            'path' => '/images/user/',
            'min_width' => 120,
            'min_height' => 120,
            'resize_width' => 120,
        ],
        self::COMPANY => [
            'slice' => true,
            'path' => '/images/company/',
            'min_width' => 120,
            'min_height' => 120,
            'resize_width' => 120,
        ],

    ];

    public static function isSquare($type)
    {
        return ArrayHelper::getValue(self::$config, "$type.square", false);
    }

    public static function getPath($type)
    {
        return ArrayHelper::getValue(self::$config, "$type.path");
    }


    public static function needResize($type)
    {
        return ArrayHelper::getValue(self::$config, "$type.resize_width", false);
    }

    public static function getMinWidth($type)
    {
        return ArrayHelper::getValue(self::$config, "$type.min_width", false);
    }

    public static function getMinHeight($type)
    {
        return ArrayHelper::getValue(self::$config, "$type.min_height", false);
    }


    public static function getRatio($type)
    {
        return ArrayHelper::getValue(self::$config, "$type.ratio", false);
    }

    public static function getRatioText($type)
    {
        return ArrayHelper::getValue(self::$config, "$type.ratio_text", false);
    }

}
