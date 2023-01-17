<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships\Contracts;

use Battleships\Enumerations\Ship;

interface ShipInterface
{
    public function __construct();

    public function setType(Ship $type) : self;
    public function getType() : Ship;

    public function setSize(int $size) : self;
    public function getSize() : int;
}