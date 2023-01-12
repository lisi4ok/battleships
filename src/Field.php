<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

declare(strict_types=1);

namespace Battleships;

final class Field extends Entity
{
    /**
     * Field Pattern
     *
     * 1  2  3  4  5  6  7  8  9  10
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  A
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  B
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  C
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  D
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  E
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  F
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  G
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  H
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  I
     * ~  ~  ~  ~  ~  ~  ~  ~  ~  ~  J
     *
     * 1  2  3  4  5  6  7  8  9  10
     * .  .  .  .  .  .  .  .  .  .  A
     * .  .  .  .  .  .  .  .  .  .  B
     * .  .  .  .  .  .  .  .  .  .  C
     * .  .  .  .  .  .  .  .  .  .  D
     * .  .  .  .  .  .  .  .  .  .  E
     * .  .  .  .  .  .  .  .  .  .  F
     * .  .  .  .  .  .  .  .  .  .  G
     * .  .  .  .  .  .  .  .  .  .  H
     * .  .  .  .  .  .  .  .  .  .  I
     * .  .  .  .  .  .  .  .  .  .  J
     *
     * @var array[]
     */
    private static $pattern = [
        'A' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'B' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'C' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'D' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'E' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'F' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'G' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'H' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'I' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
        'J' => [
            1 => self::WATER, 2 => self::WATER, 3 => self::WATER, 4 => self::WATER, 5 => self::WATER,
            6 => self::WATER, 7 => self::WATER, 8 => self::WATER, 9 => self::WATER, 10 => self::WATER,
        ],
    ];

    /**
     * Convert Field to string for User Interface
     *
     * @param array $field
     * @return string
     */
    public static function stringify(array $field = []): string
    {
        $string = '';
        if (empty($field)) {
            return $string;
        }
        for ($i=1; $i <= 10; $i++) {
            $string .= $i . '  ';
        }
        $string .= PHP_EOL;
        foreach ($field as $coordinateY => $positions) {
            foreach ($positions as $coordinateX) {
                $string .= $coordinateX . '  ';
            }
            $string .= $coordinateY . PHP_EOL;
        }
        return $string;
    }

    /**
     * Retrieve field pattern. As string or array
     *
     * @param bool $stringified
     * @return array[]|string
     */
    public static function getPattern(bool $stringified = false) : array|string
    {
        if ($stringified === true) {
            return self::stringify(self::$pattern);
        }
        return self::$pattern;
    }

    /**
     * @param string $coordinates
     * @return bool
     */
    public static function validateCoordinates(string $coordinates) : bool
    {
        $coordinates = trim($coordinates);
        if (is_string($coordinates) && strlen($coordinates) > 1 && strlen($coordinates) <= 3) {
            $y = strtoupper(substr($coordinates, 0, 1));
            if (preg_match('/[A-J]+/', $y)) {
                $x = substr($coordinates, 1);
                if (preg_match('/[0-9]+/', $x) && ($x <= 10)) {
                    return true;
                }
            }
        }
        return false;
    }
}