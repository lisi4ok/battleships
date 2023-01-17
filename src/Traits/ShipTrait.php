<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships\Traits;

use Exception;
use Battleships\Enumerations\Ship;

trait ShipTrait
{
    private static array $allowedSizeRange = [1, 5];

    public Ship $type;

    public int $size;

    public function setSize(int $size) : self
    {
        if (!in_array($size, range(self::$allowedSizeRange[0], self::$allowedSizeRange[1]))) {
            throw new Exception(
                'Allowed sizes are onyl between: "'.self::$allowedSizeRange[0].'" and "'.self::$allowedSizeRange[1].'".'
            );
        }

        $this->size = $size;

        return $this;
    }

    public function getSize() : int
    {
        return $this->size;
    }

    public function setType(Ship $type) : self
    {
        $types = Ship::values();

        if (!Ship::exists($type)) {
            throw new Exception('Allowed types are onyl: ' . implode('" and "', $types) . '.');
        }

        $this->type = $type;

        return $this;
    }

    public function getType() : Ship
    {
        return $this->type;
    }
}