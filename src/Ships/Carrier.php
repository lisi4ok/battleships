<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Ships;

final class Carrier extends Ship implements ShipInterface
{
    protected $type = 'carrier';
    protected $size = 5;

    public function __construct()
    {
        parent::__construct($this->type, $this->size);
    }
}
