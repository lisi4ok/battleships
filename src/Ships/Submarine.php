<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

declare(strict_types=1);

namespace Battleships\Ships;

use Battleships\Enumerations\Ship;
use Battleships\Traits\ShipTrait;
use Battleships\Contracts\ShipInterface;

final class Submarine implements ShipInterface
{
    use ShipTrait;

    public function __construct()
    {
        $this->setType(Ship::SUBMARINE);
        $this->setSize(1);
    }
}