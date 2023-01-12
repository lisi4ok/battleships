<?php
/**
 * @package Battleships
 * @author  Zaio Klepoyshkov <lisi4ok@gmail.com>
 */

declare(strict_types=1);

namespace Battleships;


class Game2 extends Entity
{
    /**
     * The reference to *Singleton* instance of this class
     *
     * @var \app\models\Game
     */
    private static $_instance;

    /**
     * Game Ships
     *
     * @var array
     */
    private static $_ships = [];

    /**
     * The hidden field from the user
     *
     * @var array
     */
    private static $_field = [];

    /**
     * Allowed Game stages
     *
     * @var array
     */
    private static $_allowedStages = [self::UNINITIALIZE, self::INITIALIZE, self::CLOSURE, self::DESTROY];

    /**
     * Private constructor method to prevent new *Singleton* instances
     *
     * @return void
     */
    private function __construct() {}

    /**
     * Private clone method to prevent cloning of the instance of the *Singleton* instance
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Private unserialize method to prevent unserializing of the *Singleton* instance
     *
     * @return void
     */
    private function __wakeup() {}

    /**
     * Destroy the game
     *
     * @return void
     */
    public function __destruct()
    {
        $this->_destroy();
    }

    /**
     * Retrieve specific value from cache
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        // if (Yii::$app instanceof \yii\console\Application) return Yii::$app->cache->get($key);
        // elseif (Yii::$app instanceof \yii\web\Application) return Yii::$app->session->get($key);
        // else throw new Exception;
    }

    /**
     * Set specific value to cache
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        // if (Yii::$app instanceof \yii\console\Application) Yii::$app->cache->set($key, $value);
        // elseif (Yii::$app instanceof \yii\web\Application) Yii::$app->session->set($key, $value);
        // else throw new Exception;
    }

    /**
     * Returns the *Singleton* instance of this class
     *
     * @return \app\models\Game
     */
    public static function getInstance()
    {
        if (self::$_instance === null) self::$_instance = new self;
        return self::$_instance;
    }

    /**
     * Add Ship to game defined ships
     *
     * @param \app\models\Ship $ship
     * @return \app\models\Game
     */
    public function addShip(Ship $ship)
    {
        if (!$ship instanceof Ship) throw new Exception('All Ships must be instance of use "\Battleships\Ship".');
        array_push(self::$_ships, $ship);
        return $this;
    }

    /**
     * Add Ships to game defined ships
     *
     * @param array $ships
     * @return \Battleships\Game
     */
    public function addShips(array $ships)
    {
        foreach ($ships as $ship) $this->addShip($ship);
        return $this;
    }

    /**
     * Retrieve the game stage
     *
     * @return string
     */
    public function getStage()
    {
        if (!$this->{self::STAGE}) $this->setStage(self::UNINITIALIZE);
        return $this->{self::STAGE};
    }

    /**
     * Set game stage
     *
     * @param string $stage
     * @return \app\models\Game
     */
    public function setStage($stage)
    {
        if (!in_array($stage, self::$_allowedStages)) throw new Exception('Invalid Game Stage.');
        $this->{self::STAGE} = $stage;
        return $this;
    }

    /**
     * Start the game
     *
     * @param array $ships
     * @return \app\models\Game
     */
    public function start(array $ships = [])
    {
        return $this->_init($ships);
    }

    /**
     * Begin the game
     *
     * @param array $ships
     * @return \app\models\Game
     */
    public function begin(array $ships = [])
    {
        return $this->_init($ships);
    }

    /**
     * End the game
     *
     * @param array $ships
     * @return \app\models\Game
     */
    public function closure()
    {
        $this->setStage(self::CLOSURE);
        return $this;
    }

    /**
     * Player Fire into the field
     *
     * @param string $coordinates
     * @return \app\models\Game
     */
    public function fire($coordinates)
    {
        if ($this->getStage() !== self::INITIALIZE) throw new Exception('Please initialize the game.FF');
        $coordinates = strtoupper($coordinates);
        if (!Helper::validateCoordinates($coordinates)) throw new Exception('Invalid Coordinates.');
        $y = strtoupper(substr($coordinates, 0, 1));
        $x = substr($coordinates, 1);
        $visibleField = $this->{self::VISIBLE_FIELD};
        $hiddenfield = $this->{self::HIDDEN_FIELD};
        if ($visibleField[$y][$x] === self::HIT || $visibleField[$y][$x] === self::MISS) {
            throw new Exception('You already fire at this field.');
        } elseif ($hiddenfield[$y][$x] === self::WATER) {
            $visibleField[$y][$x] = self::MISS;
            $this->{self::MISSES} = $this->{self::MISSES} + 1;
        } elseif ($hiddenfield[$y][$x] === self::SHIP_PART) {
            $visibleField[$y][$x] = self::HIT;
            $this->{self::HITS} = $this->{self::HITS} + 1;
        }
        $this->{self::VISIBLE_FIELD} = $visibleField;
        return $this;
    }

    /**
     * Retrieve the battlefield - visible field to the user
     *
     * @return array|string
     */
    public function getBattleField($stringified = false)
    {
        if ($this->getStage() !== self::INITIALIZE) throw new Exception('Please initialize the game.');
        if ($stringified === true) return Field::stringify($this->{self::VISIBLE_FIELD});
        return $this->{self::VISIBLE_FIELD};
    }

    /**
     * Retrieve the hiddenfield - invisible field to the user
     *
     * @return array|string
     */
    public function getHiddenField($stringified = false)
    {
        if ($this->getStage() !== self::CLOSURE) throw new Exception('Please end the game.');
        if ($stringified === true) return Field::stringify($this->{self::HIDDEN_FIELD});
        return $this->{self::HIDDEN_FIELD};
    }

    /**
     * Place all the ships into the hidden field
     *
     * @return \app\models\Game
     */
    private function _placeShipsIntoField()
    {
        self::$_field = Field::getPattern();
        $filled = [];
        foreach (self::$_ships as $key => $ship) {
            while (true) {
                $dimension = (mt_rand(0,1) == 1 ? self::POSITION_HORIZONTAL : self::POSITION_VERTICAL);
                $max = [self::POSITION_HORIZONTAL => 10, self::POSITION_VERTICAL => 10];
                $max[$dimension] -= $ship->getSize();
                $x = mt_rand(1, $max[self::POSITION_HORIZONTAL]);
                $y = mt_rand(1, $max[self::POSITION_VERTICAL]);
                for ( $i = 0; $i < $ship->getSize(); $i++ ) {
                    $curr = array( self::POSITION_HORIZONTAL => $x, self::POSITION_VERTICAL => $y );
                    $curr[$dimension] += $i;
                    if (isset($filled[$curr[self::POSITION_HORIZONTAL]][$curr[self::POSITION_VERTICAL]])) continue 2;
                }
                break;
            }
            for ($i = 0; $i < $ship->getSize(); $i++) {
                $curr = [self::POSITION_HORIZONTAL => $x, self::POSITION_VERTICAL => $y];
                $curr[$dimension] += $i;
                $filled[$curr[self::POSITION_HORIZONTAL]][$curr[self::POSITION_VERTICAL]] = $key;
            }
        }
        for ($row = 1; $row <= 10; $row++) {
            for ($col = 1; $col <= 10; $col++) {
                if (self::$_field[self::$y[$row]][self::$x[$col]] == self::WATER && isset($filled[$row][$col])) {
                    self::$_field[self::$y[$row]][self::$x[$col]] = self::SHIP_PART;
                }
            }
        }
        return $this;
    }

    /**
     * Initialize the game
     *
     * @param array $ships
     * @return \app\models\Game
     */
    private function _init(array $ships = [])
    {
        if ($this->getStage() === self::UNINITIALIZE || $this->getStage() === self::CLOSURE) {
            if (empty($ships) && empty(self::$_ships)) throw new Exception('Please define all ships to the game.');
            if (!empty($ships)) $this->addShips($ships);
            $this->_placeShipsIntoField();
            $this->{self::HIDDEN_FIELD} = self::$_field;
            $this->{self::VISIBLE_FIELD} = Field::getPattern();
            $this->{self::HITS} = 0;
            $this->{self::MISSES} = 0;
            $this->setStage(self::INITIALIZE);
            return $this;
        }
        return $this;
    }

    /**
     * Destroy the game
     *
     * @return void
     */
    private function _destroy()
    {
        self::$_ships = [];
        self::$_field = [];
        self::$_instance = null;
        if (Yii::$app instanceof \yii\console\Application) Yii::$app->cache->flush();
        elseif (Yii::$app instanceof \yii\web\Application) Yii::$app->session->destroy();
        else throw new Exception;
    }

    public function destroy()
    {
        $this->_destroy();
    }
}