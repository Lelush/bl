<?php

namespace common\helpers;

/**
 * Класс для доп.методов работы с цифрами
 *
 * @package common\helpers
 */
class HNumbers
{
    /**
     * @param $number float
     * @param int $decimal
     * @param string $dec_point
     * @param string $thousands_sep
     * @return string
     */
    public static function format($number, $decimal =0, $dec_point = ".", $thousands_sep = "," )
    {
        if(is_null($number)){
            $number = 0;
        }
        return number_format($number, $decimal, $dec_point, $thousands_sep);
    }

}

?>