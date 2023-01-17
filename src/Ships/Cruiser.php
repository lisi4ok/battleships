<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships\Ships;

use Battleships\Enumerations\Ship;
use Battleships\Traits\ShipTrait;
use Battleships\Contracts\ShipInterface;

final class Cruiser implements ShipInterface
{
    use ShipTrait;

    public function __construct()
    {
        $this->setType(Ship::CRUISER);
        $this->setSize(3);
    }
}