<?php

namespace common\enums;


class UserGender extends Enum
{
    const MALE = 1;
    const FEMALE = 2;

    public static function getList()
    {
        return [
            self::MALE => "мужской",
            self::FEMALE => "женский",
        ];
    }
}
