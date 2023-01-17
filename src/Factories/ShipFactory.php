<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships\Factories;

use Battleships\Ships\Carrier;
use Battleships\Ships\Battleship;
use Battleships\Ships\Destroyer;
use Battleships\Ships\Cruiser;
use Battleships\Ships\Submarine;
use Battleships\Enumerations\Ship;
use Battleships\Contracts\ShipInterface;

abstract class ShipFactory
{
    public static array $ships = [];

    public static function create($type) : ShipInterface
    {
        switch ($type) {
            case Ship::CARRIER:
                return new Carrier;
                break;
            case Ship::BATTLESHIP:
                return new Battleship;
                break;
            case Ship::CRUISER:
                return new Cruiser;
                break;
            case Ship::DESTROYER:
                return new Destroyer;
                break;
            case Ship::SUBMARINE:
                return new Submarine;
                break;
        }
    }

    public static function createAll()
    {
        $ships = Ship::cases();
        foreach ($ships as $ship) {
            self::$ships[] = self::create($ship);
        }

        return self::$ships;
    }
}