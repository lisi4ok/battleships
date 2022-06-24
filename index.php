<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP BattleShips Game</title>
</head>
<body>
<pre>
<?php
//$time_start = microtime(true);

require __DIR__.'/vendor/autoload.php';

use Battleships\Field;
use Battleships\Ships\Carrier;
use Battleships\Ships\Battleship;
use Battleships\Ships\Cruiser;
use Battleships\Ships\Destroyer;
use Battleships\Ships\Submarine;
use Battleships\Game;
use Battleships\Cache;

$path = './var/cache';
$ships = [
    new Carrier,
    new Battleship,
    new Cruiser,
    new Destroyer, new Destroyer,
    new Submarine, new Submarine,
];
$game = new Game((new Cache($path)), $ships);
$player1 = $game->addPlayer();
$player2 = $game->addPlayer();

//$game->begin();



$game->addPlayer();
$game->addPlayer();
if (!$game->getCache()->get('game')) {
    $game->addPlayer();
    $game->addPlayer();
    $game->getCache()->set('game', true);
}

echo Field::stringify($game->getCache()->get('players')[1]['field']);
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo Field::stringify($game->getCache()->get('players')[2]['field']);
exit;

//$time_end = microtime(true);
//$execution_time = ($time_end - $time_start);
//echo '<b>Execution Time:</b> '. number_format((float) $execution_time, 10).' Secconds' . PHP_EOL;
?>
</pre>
</body>
</html>
