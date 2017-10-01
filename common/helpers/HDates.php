<?php

namespace common\helpers;

/**
 * Класс для доп.методов работы с датами
 *
 * @package common\helpers
 */
class HDates
{

    const TODAY = 'today';
    const YESTERDAY = 'yesterday';
    const CURR_WEEK = 'curr_week';
    const LAST_WEEK = 'last_week';
    const CURR_MONTH = 'curr_month';
    const LAST_MONTH = 'last_month';


    /**
     * Возвращает дату в формате Y-m-d H:i:s
     * @param mixed $timestamp - null, timestamp или string
     * @return string
     */
    public static function long($timestamp = null)
    {
        return date("Y-m-d H:i:s", HDates::prepareTimestamp($timestamp));
    }

    /**
     * Возвращает дату в формате Y-m-d
     * @param mixed $timestamp - null, timestamp или string
     * @return string
     */
    public static function short($timestamp = null)
    {
        return date("Y-m-d", HDates::prepareTimestamp($timestamp));
    }

    /**
     * Возвращает дату в формате d.m.Y
     * @param null $timestamp
     * @return bool|string
     */
    public static function dmY($timestamp = null)
    {
        return date("d.m.Y", HDates::prepareTimestamp($timestamp));
    }
    /**
     * Возвращает дату в формате d.m.Y
     * @param null $timestamp
     * @return bool|string
     */
    public static function dFHi($timestamp = null)
    {
        return date("d F, H:i", HDates::prepareTimestamp($timestamp));
    }
    /**
     * Возвращает дату в формате H:i:s
     * @param null $timestamp
     * @return bool|string
     */
    public static function His($timestamp = null)
    {
        return date("H:i:s", HDates::prepareTimestamp($timestamp));
    }

    /**
     * Возвращает дату в формате Y-m-d H:i
     * @param mixed $timestamp - null, timestamp или string
     * @return string
     */
    public static function ui($timestamp = null)
    {
        return date("Y-m-d H:i", HDates::prepareTimestamp($timestamp));
    }

    /**
     * Проверяет формат UNIX Timestamp
     *
     * @param $timestamp
     * @return bool
     */
    public static function isTimestamp($timestamp)
    {
        return ((string) (int) $timestamp === (string) $timestamp);
        //	&& ($timestamp <= PHP_INT_MAX)
        //	&& ($timestamp >= ~PHP_INT_MAX)
        //	&& (!strtotime($timestamp));
    }

    /**
     * Возвращает дату в формате UNIX Timestamp
     * @param mixed $timestamp - null, timestamp или string
     * @param null $format
     * @return int
     */
    public static function prepareTimestamp($timestamp = null, $format = null)
    {
        if (is_null($timestamp)) {
            return time();
        }

        if ($format) {
            $date = \DateTime::createFromFormat($format, $timestamp);

            return $date->getTimestamp();
        }

        if (!HDates::isTimestamp($timestamp)) {
            return strtotime($timestamp);
        }

        return $timestamp;
    }
    /**
     * Возвращает дату в формате H:i:s
     * @param null $timestamp
     * @return bool|string
     */
    public static function m($timestamp = null)
    {
        return date("m", HDates::prepareTimestamp($timestamp));
    }

    /**
     * @param null $timestamp
     * @return bool|string
     */
    public static function FdYHi($timestamp = null)
    {
        $months = static::monthsList();
        $month = $months[static::m($timestamp)];
        return date("$month, d, Y, H:i", HDates::prepareTimestamp($timestamp));
    }

    /**
     * @param null $timestamp
     * @return bool|string
     */
    public static function FdHi($timestamp = null)
    {
        $months = static::monthsList();
        $month = $months[static::m($timestamp)];
        return date("$month, d, H:i", HDates::prepareTimestamp($timestamp));
    }

    public static function monthsList()
    {
        return [
            '01' => 'Январь',
            '02' => 'Февраль',
            '03' => 'Март',
            '04' => 'Апрель',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Август',
            '09' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь',
        ];
    }

    function date_rus2eng($text)
    {
        //краткаие месяцы
        $eng = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        $rus = array("Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек");

        return str_replace(","," ",str_replace($rus, $eng, $text));
    }

    public static function getStartByPeriod($period)
    {
        $currDate = new \DateTime();
        switch($period){
            case self::YESTERDAY:
                return HDates::short($currDate->modify('-1 day')->getTimestamp());
                break;
            case self::CURR_WEEK:
                return HDates::short($currDate->modify('last monday')->getTimestamp());
                break;
            case self::LAST_WEEK:
                return HDates::short($currDate->modify('-1 week')->modify('last monday')->getTimestamp());
                break;
            case self::CURR_MONTH:
                return HDates::short($currDate->modify('first day of this month')->getTimestamp());
                break;
            case self::LAST_MONTH:
                return HDates::short($currDate->modify('-1 month')->modify('first day of this month')->getTimestamp());
                break;
            case self::TODAY:
            default:
                return HDates::short($currDate->getTimestamp());
        }
    }

    public static function getEndByPeriod($period)
    {
        $currDate = new \DateTime();
        switch($period){
            case self::TODAY:
                return HDates::short($currDate->getTimestamp());
                break;
            case self::YESTERDAY:
                return HDates::short($currDate->modify('-1 day')->getTimestamp());
                break;
            case self::LAST_WEEK:
                return HDates::short($currDate->modify('-1 week')->modify('next sunday')->getTimestamp());
                break;
            case self::LAST_MONTH:
                return HDates::short($currDate->modify('-1 month')->modify('last day of this month')->getTimestamp());
                break;
            case self::CURR_WEEK:
            case self::CURR_MONTH:
            default:
                return HDates::short($currDate->getTimestamp());
        }
    }

    public static function StampType($timestamp = '')
    {
        if ($timestamp) {
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}\:\d{2}\:\d{2}$/',$timestamp))
            {
                return 'full';
            }
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/',$timestamp))
            {
                return 'short';
            }
        }

        return false;
    }
}

?>