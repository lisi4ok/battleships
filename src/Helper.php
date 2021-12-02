<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships;

class Helper
{
    /**
     * Validate incoming coordinates typed by the user
     *
     * @param string $coordinates
     * @return bool
     */
    public static function validateCoordinates($coordinates)
    {
        $coordinates = trim($coordinates);
        if (is_string($coordinates) && strlen($coordinates) > 1 && strlen($coordinates) <= 3) {
            $y = strtoupper(substr($coordinates, 0, 1));
            if (preg_match('/[A-Z]+/', $y)) {
                $x = (int) substr($coordinates, 1);
                if (preg_match('/[0-9]+/', $x) && ($x <= 10)) return true;
            }
        }
        return false;
    }

    /**
     * Normalize session flash keys
     *
     * @param string $key
     * @return string
     */
    public static function normalizeSessionFlashKeys($key)
    {
        if (!is_string($key)) return '';
        return preg_replace('/[_]+/', '', trim($key));
    }
}