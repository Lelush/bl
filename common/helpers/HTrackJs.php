<?php

namespace common\helpers;

use common\enums\ClickType;
use common\models\Click;
use yii\helpers\ArrayHelper;

/**
 * Класс для работы с трекинговыми урлами
 *
 * @package common\helpers
 */
class HTrackJs
{
    /**
     * Очистка массива от нечисти, которая могла прийти из js
     *
     * @param $arr Указатель на массив, в котором производим чистку
     */
    public static function clear(&$arr)
    {
        foreach ($arr as $key => $value)
            if ($value == 'undefined' || $value == 'null')
                $arr[$key] = null;
    }

    /**
     * Преобразует урл в массив, содержащий host, scheme и params урла $url
     *
     * @param $url урл для перобразования
     * @return array
     */
    public static function parseParams($url)
    {
        $parsedUrl = parse_url($url);
        $params = self::parseQuery(ArrayHelper::getValue($parsedUrl,'query',''));

        return [
            'host' => ArrayHelper::getValue($parsedUrl, 'host'),
            'scheme' => ArrayHelper::getValue($parsedUrl, 'scheme'),
            'params' => $params
        ];

    }

    /**
     * Преобразует строку с GET-параметрами в массива ключ-значение
     *
     * @param $query строка вида param1=value1&param2=value2
     * @return array ассоциативный массив param=>value
     */
    public static function parseQuery($query)
    {
        $queryParts = explode("&", $query);
        $params = [];
        foreach ($queryParts as $queryPart) {
            $parts = explode("=",$queryPart);
            if (count($parts)!=2) continue;

            $params[$parts[0]] = $parts[1];
        }

        return $params;
    }

    /**
     * Возвращает тип клика - внутренний переход,внешний или первичный
     *
     * @param $urlHost Хост страницы, на которой сработал пиксель
     * @param $refererHost Хост реферера страницы с пикселем
     * @return string ClickType::NONE | ClickType::INTERNAL | ClickType::EXTERNAL
     */
    public static function getClickType($urlHost, $refererHost)
    {
        if (!$refererHost)
            return ClickType::NONE;

        if ($refererHost == $urlHost)
            return ClickType::INTERNAL;

        return ClickType::EXTERNAL;
    }


}

?>