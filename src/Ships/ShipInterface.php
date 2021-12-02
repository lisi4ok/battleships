<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Ships;

interface ShipInterface
{
    public function setType($type = null);
    public function getType();

    public function setSize($size = null);
    public function getSize();
}