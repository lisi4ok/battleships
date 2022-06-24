<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Ships;

final class Submarine extends Ship implements ShipInterface
{
    protected $type = 'submarine';
    protected $size = 3;

    public function __construct()
    {
        parent::__construct($this->type, $this->size);
    }
}
