<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

declare(strict_types=1);

namespace Battleships;

final class Player extends Entity
{
    private array $field = [];

    public function __construct(array $ships)
    {
        $this->placeShipsIntoField($ships);
    }

    /**
     * @return array
     */
    public function getField(): array
    {
        return $this->field;
    }

    /**
     * @param array $field
     */
    public function setField(array $field)
    {
        $this->field = $field;
    }

    /**
     * @return $this
     */
    private function placeShipsIntoField(array $ships): self
    {
        $this->field = Field::getPattern();
        $filled = [];
        foreach ($ships as $key => $ship) {
            while (true) {
                $dimension = (mt_rand(0,1) == 1 ? self::POSITION_HORIZONTAL : self::POSITION_VERTICAL);
                $max = [self::POSITION_HORIZONTAL => 10, self::POSITION_VERTICAL => 10];
                $max[$dimension] -= $ship->getSize();
                $x = mt_rand(1, $max[self::POSITION_HORIZONTAL]);
                $y = mt_rand(1, $max[self::POSITION_VERTICAL]);
                for ($i = 0; $i < $ship->getSize(); $i++) {
                    $curr = [self::POSITION_HORIZONTAL => $x, self::POSITION_VERTICAL => $y];
                    $curr[$dimension] += $i;
                    if (isset($filled[$curr[self::POSITION_HORIZONTAL]][$curr[self::POSITION_VERTICAL]])) {
                        continue 2;
                    }
                }
                break;
            }
            for ($i = 0; $i < $ship->getSize(); $i++) {
                $curr = [self::POSITION_HORIZONTAL => $x, self::POSITION_VERTICAL => $y];
                $curr[$dimension] += $i;
                $filled[$curr[self::POSITION_HORIZONTAL]][$curr[self::POSITION_VERTICAL]] = $key;
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