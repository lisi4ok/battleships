<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP BattleShips Game</title>
</head>
<body>
<pre>
<?php
require __DIR__.'/vendor/autoload.php';

use Battleships\Ships\Battleship;
use Battleships\Ships\Destroyer;
use Battleships\Game;
use Battleships\Cache;

$path = './var/cache';
$ships = [new Battleship, new Destroyer];

$game = new Game((new Cache($path)), $ships);
$game->addPlayer();
//$game->addPlayer();

echo '<pre>';
var_dump($game->getPlayers());
exit;

?>
</pre>
</body>
</html>
