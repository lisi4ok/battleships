<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
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
    public static $x = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10];

    /**
     * Vertical coordinates
     *
     * @var array
     */
    public static $y = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J'];
}