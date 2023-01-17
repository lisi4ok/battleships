<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 *
 */

declare(strict_types=1);

namespace Battleships\Ships;

use Battleships\Enumerations\Ship;
use Battleships\Traits\ShipTrait;
use Battleships\Contracts\ShipInterface;

final class Carrier implements ShipInterface
{
    use ShipTrait;

    public function __construct()
    {
        $this->setType(Ship::CARRIER);
        $this->setSize(5);
    }
}