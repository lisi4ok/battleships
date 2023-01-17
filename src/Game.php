<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships;

use Battleships\Contracts\ShipInterface;
use Psr\SimpleCache\CacheInterface;

final class Game
{
    protected CacheInterface $cache;

    /**
     * @var \Battleships\Contracts\ShipInterface[]
     */
    protected array $ships = [];

    /**
     * @var \Battleships\Player[]
     */
    protected array $players = [];

    public function __construct(CacheInterface $cache, array $ships)
    {
        $this->setCache($cache);
        $this->addShips($ships);

    }

    public function addShip(ShipInterface $ship) : self
    {
        array_push($this->ships, $ship);
        return $this;
    }

    /**
     * @param \Battleships\Contracts\ShipInterface[] $ships
     * @return $this
     */
    public function addShips(array $ships) : self
    {
        foreach ($ships as $ship) {
            $this->addShip($ship);
        }
        return $this;
    }

    /**
     * @return \Battleships\Contracts\ShipInterface[]
     */
    public function getShips() : array
    {
        return $this->ships;
    }

    public function addPlayer() : self
    {
        $player = new Player($this->getShips());
        array_push($this->players, $player);
        $cache = [];
        foreach ($this->players as $playerNumber => $player) {
            $playerNumber += 1;
            $cache[$playerNumber] = $player;
        }
        $this->getCache()->set('players', $cache);
        return $this;
    }

    public function getPlayers() : array
    {
        return $this->getCache()->get('players');
    }

    public function getPlayer(int $player) : Player
    {
        return $this->getPlayers()[$player];
    }

    public function __destruct()
    {
        $this->cache->clear();
    }

    public function getCache() : CacheInterface
    {
        return $this->cache;
    }

    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public static function validateCoordinates(string $coordinates) : bool
    {
        $coordinates = trim($coordinates);
        if (is_string($coordinates) && strlen($coordinates) > 1 && strlen($coordinates) <= 3) {
            $y = strtoupper(substr($coordinates, 0, 1));
            if (preg_match('/[A-J]+/', $y)) {
                $x = substr($coordinates, 1);
                if (preg_match('/[0-9]+/', $x) && ($x <= 10)) {
                    return true;
                }
            }
        }
        return false;
    }
}