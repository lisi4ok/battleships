<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Traits;

trait ArrayableEnumeration
{
    public static function names() : array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values() : array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array() : array
    {
        return array_combine(self::names(), self::values());
    }

    public static function exists($case)
    {
        return array_search($case, self::cases()) !== false;
    }
}