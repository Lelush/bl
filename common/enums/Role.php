<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 4/24/15
 * Time: 2:04 PM
 */

namespace common\enums;


class Role extends Enum
{
    const GUEST = 'guest';
    const MANAGER = 'manager';
    const COMPANY = 'company';
    const USER = 'user';
    const ADMIN = 'admin';

    public static function getList()
    {
        return [
            self::GUEST => "Гость",
            self::MANAGER => "Менеджер",
            self::USER => "Пользователь",
            self::COMPANY => "Компания",
            self::ADMIN => "Админ",
        ];
    }

    public static function getAdvertiserRoleList()
    {
        return [
            self::COMPANY => "Компания",
        ];
    }

    public static function getAdminsRoleList()
    {
        return [
            self::MANAGER => "Менеджер",
            self::ADMIN => "Админ",
        ];
    }

    public static function getUserRoleList()
    {
        return [
            self::USER => "Пользователь",
            self::COMPANY => "Компания",
        ];
    }
}
