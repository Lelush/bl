<?php

namespace common\enums;


class FriendsStatus extends Enum
{
    const WAIT      = 0; //follow
    const REQUEST   = 1;
    const ACCEPT    = 2;
    const DELETE    = 99;

    public static function getList()
    {
        return [
            self::WAIT => "В ожидании",
            self::REQUEST => "Запрос дружбы",
            self::ACCEPT => "Подтеверждение дружбы",
            self::DELETE => "Удаление из друзей",
        ];
    }
}
