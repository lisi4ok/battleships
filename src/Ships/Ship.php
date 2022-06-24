<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

namespace Battleships\Ships;

use Exception;
use Battleships\Entity;

abstract class Ship extends Entity implements ShipInterface
{
	/**
	 * Allowed Ship Types
	 *
	 * @var array
	 */
	protected static $allowedTypes = ['carrier', 'battleship', 'cruiser', 'destroyer', 'submarine'];

	/**
	 * Allowed Ship Size Range
	 *
	 * @var array
	 */
    protected static $allowedSizeRange = [1, 5];

	/**
	 * Ship Type
	 *
	 * @var null|string
	 */
	protected $type = null;

	/**
	 * Ship Size
	 *
	 * @var null|int
	 */
    protected $size = null;

	/**
	 * @param null|string $type
	 * @param null|int $size
	 */
	public function __construct($type = null, $size = null)
	{
		if ($this->type === null) $this->setType($type);
		if ($this->size === null) $this->setSize($size);
	}

	/**
	 * Set Ship Size
	 *
	 * @param null|int $size
	 * @return \app\models\Ship
	 */
	public function setSize($size = null)
	{
		if ($size === null) {
			$this->size = rand(self::$allowedSizeRange[0], self::$allowedSizeRange[1]);
			return;
		}
		if (!in_array($size, range(self::$allowedSizeRange[0], self::$allowedSizeRange[1]))) {
            throw new Exception('Allowed sizes are onyl between: "'.self::$allowedSizeRange[0].'" and "'.self::$allowedSizeRange[1].'".');
        }
		$this->size = $size;
		return $this;
	}

	/**
	 * Get Ship Size
	 *
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Set Ship Type
	 *
	 * @param null|string $type
	 * @return \app\models\Ship
	 */
	public function setType($type = null)
	{
		if ($type === null) {
			$this->type = self::$allowedTypes[array_rand(self::$allowedTypes, 1)];
			return;
		}
		if (!in_array($type, self::$allowedTypes))
			throw new Exception('Allowed types are onyl: ' . implode('" and "', self::$allowedTypes) . '.');
		$this->type = $type;
		return $this;
	}

	/**
	 * Get Ship Type
	 *
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
}
