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
use Battleships\Ships\Battleship;
use Battleships\Ships\Destroyer;
use Battleships\Game;
use Battleships\Cache;

$path = './var/cache';
$ships = [new Battleship, new Destroyer];

$game = new Game((new Cache($path)), $ships);
$game->addPlayer();
$game->addPlayer();

$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo '<b>Execution Time:</b> '. number_format((float) $execution_time, 10).' Secconds' . PHP_EOL;
?>
</pre>
</body>
</html>