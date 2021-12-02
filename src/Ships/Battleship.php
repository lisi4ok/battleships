<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Ships;

final class Battleship extends Ship implements ShipInterface
{
	protected $type = 'battleship';
    protected $size = 5;

	public function __construct()
	{
		parent::__construct($this->type, $this->size);
	}
}