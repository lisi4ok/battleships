<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Contracts;

use Battleships\Enumerations\Ship;

interface ShipInterface
{
    public function __construct();

    public function setType(Ship $type) : self;
    public function getType() : string;

    public function setSize(int $size) : self;
    public function getSize() : int;
}