<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP BattleShips Game</title>
</head>
<body>
<pre>
<?php

$time_start = microtime(true);

require __DIR__.'/vendor/autoload.php';

use Battleships\Field;
use \Battleships\Factories\ShipFactory;
use Battleships\Game;
use Battleships\Cache;

$path = './var/cache';


$game = new Game((new Cache($path)), ShipFactory::createAll());
$player1 = $game->addPlayer();
$player2 = $game->addPlayer();



$game->addPlayer();
$game->addPlayer();
if (!$game->getCache()->has('game')) {
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

echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo '<b>Execution Time:</b> '. number_format((float) $execution_time, 10).' Secconds' . PHP_EOL;
?>
</pre>
</body>
</html>