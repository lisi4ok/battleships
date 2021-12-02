<?php
/*
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

declare(strict_types=1);

namespace Battleships;

use Battleships\Ships\ShipInterface;

final class Game extends Entity
{
    /**
     * @var \Battleships\Cache
     */
    protected $cache;

    /**
     * @var \Battleships\Ships\ShipInterface[]
     */
    protected $ships = [];

    /**
     * @var \Battleships\Player[]
     */
    protected $players = [];

    public function __construct(Cache $cache, array $ships)
    {
        $this->setCache($cache);
        $this->addShips($ships);
        
    }

    public function addShip(ShipInterface $ship): self
    {
        array_push($this->ships, $ship);
        return $this;
    }

    /**
     * @param \Battleships\Ships\ShipInterface[] $ships
     * @return $this
     */
    public function addShips(array $ships): self
    {
        foreach ($ships as $ship) {
            $this->addShip($ship);
        }
        return $this;
    }

    /**
     * @return ShipInterface[]
     */
    public function getShips(): array
    {
        return $this->ships;
    }

    public function addPlayer(): self
    {
        array_push($this->players, new Player($this->getShips()));
        return $this;
    }

    public function getPlayers()
    {
        return $this->players;
    }
    
    /**
     * Destroy the game
     *
     * @return void
     */
    public function __destruct()
    {
        $this->cache->clear();
    }

    /**
     * @return \Battleships\Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param \Battleships\Cache $cache
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
    }
}