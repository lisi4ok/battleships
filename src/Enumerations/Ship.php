<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

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