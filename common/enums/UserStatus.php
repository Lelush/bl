<?php

namespace common\enums;


class UserStatus extends Enum
{
    const DELETED = 0;
    const ACTIVE = 10;

    public static function getList()
    {
        return [
            self::DELETED => "Отключен",
            self::ACTIVE => "Активен",
        ];
    }

    public static function getCssClass($status)
    {
        switch($status){
            case self::ACTIVE:
                return 'primary';
                break;
            case self::DELETED:
                return 'danger';
                break;
            default:
                return 'default';
        }
    }
}
