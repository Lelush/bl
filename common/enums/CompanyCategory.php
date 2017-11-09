<?php

namespace common\enums;


class CompanyCategory extends Enum
{
    const ENTERTAINMENT = 1;
    const SERVICES = 2;
    const SHOPPING = 3;
    const FOOD = 4;

    public static function getList()
    {
        return [
            self::ENTERTAINMENT => "Развлечения",
            self::SERVICES => "Услуги",
            self::SHOPPING => "Шопинг",
            self::FOOD => "Питание",
        ];
    }
}
