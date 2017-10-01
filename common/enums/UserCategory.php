<?php

namespace common\enums;


class UserCategory extends Enum
{
    const DISCOUNTER = 1;
    const POPULAR = 2;
    const LUXURY = 3;
    const RICH = 4;
    const TOURIST = 5;

    public static function getList()
    {
        return [
            self::DISCOUNTER => "DISCOUNTER",
            self::POPULAR => "POPULAR",
            self::LUXURY => "LUXURY",
            self::RICH => "RICH",
            self::TOURIST => "TOURIST",
        ];
    }
}
