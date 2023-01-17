<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships;

final class Field
{
    const HORIZONTAL = 'x';
    const VERTICAL   = 'y';

    const WATER = '~';
    const SHIP_PART = '#';
//    const WATER = '.';
//    const SHIP_PART = '=';

    const HIT = 'X';
    const MISS = 'O';

    const VISIBLE = 1;
    const HIDDEN = 0;

    /**
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
     */
    private static array $pattern = [
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

    private static array $x = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10];

    /**
     * Vertical coordinates
     *
     * @var array
     */
    private static array $y = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J'];

    private array $field = [];
    private ?int $type;

    public function __construct(array $ships = null)
    {
        if ($ships !== null) {
            $this->setType(self::VISIBLE);
            $this->placeShips($ships);
        } else {
            $this->field = static::$pattern;
            $this->setType(self::HIDDEN);
        }
    }

    public function get(bool $stringified = false) : array|string
    {
        if ($stringified === true) {
            return self::stringify($this->field);
        }

        return $this->field;
    }

    public function setType(int $type) : self
    {
        $this->type = $type;

        return $this;
    }

    public function getType() : int
    {
        return $this->type;
    }

    private static function stringify(array $field = []) : string
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

    private function placeShips(array $ships) : self
    {
        $this->field = static::$pattern;

        $filled = [];
        foreach ($ships as $key => $ship) {
            while (true) {
                $dimension = (mt_rand(0,1) == 1 ? self::HORIZONTAL : self::VERTICAL);
                $max = [self::HORIZONTAL => 10, self::VERTICAL => 10];
                $max[$dimension] -= $ship->getSize();
                $x = mt_rand(1, $max[self::HORIZONTAL]);
                $y = mt_rand(1, $max[self::VERTICAL]);
                for ($i = 0; $i < $ship->getSize(); $i++) {
                    $curr = [self::HORIZONTAL => $x, self::VERTICAL => $y];
                    $curr[$dimension] += $i;
                    if (isset($filled[$curr[self::HORIZONTAL]][$curr[self::VERTICAL]])) {
                        continue 2;
                    }
                }
                break;
            }
            for ($i = 0; $i < $ship->getSize(); $i++) {
                $curr = [self::HORIZONTAL => $x, self::VERTICAL => $y];
                $curr[$dimension] += $i;
                $filled[$curr[self::HORIZONTAL]][$curr[self::VERTICAL]] = $key;
            }
        }
        for ($row = 1; $row <= 10; $row++) {
            for ($col = 1; $col <= 10; $col++) {
                if ($this->field[self::$y[$row]][self::$x[$col]] == self::WATER && isset($filled[$row][$col])) {
                    $this->field[self::$y[$row]][self::$x[$col]] = self::SHIP_PART;
                }
            }
        }

        return $this;
    }
}