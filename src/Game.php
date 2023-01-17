<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <master@lisi4ok.com>
 */

declare(strict_types=1);

namespace Battleships;

use Battleships\Contracts\ShipInterface;
use Psr\SimpleCache\CacheInterface;

final class Game extends Entity
{
    protected CacheInterface $cache;

    /**
     * @var \Battleships\Contracts\ShipInterface[]
     */
    protected $ships = [];

    /**
     * @var \Battleships\Player[]
     */
    protected $players = [];

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
            $cache[$playerNumber]['field'] = $player->getField();
        }
        $this->getCache()->set('players', $cache);
        return $this;
    }

    public function getPlayers()
    {
        return $this->getCache();
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
}