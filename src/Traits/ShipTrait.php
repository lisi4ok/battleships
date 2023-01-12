<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Traits;

use Exception;
use Battleships\Enumerations\Ship;

trait ShipTrait
{
    /**
     * Allowed Ship Size Range
     *
     * @var array
     */
    private static $allowedSizeRange = [1, 5];

    /**
     * Ship Type
     *
     * @var null|string
     */
    public $type = null;

    /**
     * Ship Size
     *
     * @var null|int
     */
    public $size = null;

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

    public function getType() : string
    {
        return $this->type;
    }
}