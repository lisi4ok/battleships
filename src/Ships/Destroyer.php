<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Ships;

final class Destroyer extends Ship implements ShipInterface
{
    protected $type = 'destroyer';
    protected $size = 4;

	public function __construct()
	{
		parent::__construct($this->type, $this->size);
	}
}