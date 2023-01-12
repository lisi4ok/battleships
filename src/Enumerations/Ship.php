<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Enumerations;

use Battleships\Traits\ArrayableEnumeration;

enum Ship: string
{
    use ArrayableEnumeration;

    case CARRIER    = 'carrier';
    case BATTLESHIP = 'battleship';
    case CRUISER    = 'cruiser';
    case DESTROYER  = 'destroyer';
    case SUBMARINE  = 'submarine';
}