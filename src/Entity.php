<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships;

abstract class Entity
{
    const WATER = '~';
    const SHIP_PART = '#';
//    const WATER = '.';
//    const SHIP_PART = '=';
    const HIT = 'X';
    const MISS = 'O';

    const POSITION_HORIZONTAL = 'x';
    const POSITION_VERTICAL = 'y';

    const HIDDEN_FIELD = 'hf';
    const VISIBLE_FIELD = 'vf';

    /**
     * Game Entities
     */
    const STAGE = 'stage';
    const UNINITIALIZE = 'uninitialize';
    const INITIALIZE = 'initialize';
    const CLOSURE = 'closure';
    const DESTROY = 'destroy';
    const HITS = 'hits';
    const MISSES = 'misses';

    /**
     * Horizontal coordinates
     *
     * @var array
     */
    public static array $x = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10];

    /**
     * Vertical coordinates
     *
     * @var array
     */
    public static array $y = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J'];

    public function serialize()
    {
        $res = [];

        $reflect = new \ReflectionClass(__CLASS__);
        $propList = $reflect->getProperties();

        foreach($propList as $prop) {
            if ($prop->class != __CLASS__) {
                continue; // visible properties of base clases
            }

            $name = $prop->name;
            $res[$name . ":" . __CLASS__] = serialize($this->$name);
        }

        if (method_exists(get_parent_class(__CLASS__), "serialize")) {
            $base = unserialize(self::serialize());
            $res = array_merge($res, $base);
        }

        return serialize($res);
    }

    public function unserialize($data) {

        $values = unserialize($data);
        foreach ($values as $key => $value) {

            $prop = explode(":", $key);
            if ($prop[1] != __CLASS__) {
                continue;
            }

            $this->$prop[0] = unserialize($value);
        }

        if (method_exists(get_parent_class(__CLASS__), "unserialize")) {
            self::unserialize($data);
        }
    }
}