<?php
ini_set('memory_limit', '2048M');
function playMarbleGame($players, $lastMarbleNumber) {
	$start = microtime(true);
	$cwMarbles = array_fill(0, $lastMarbleNumber + 1, -1); // the clockwise marbles
	$ccwMarbles = array_fill(0, $lastMarbleNumber + 1, -1); // the counter clockwise marbles
	$cwMarbles[0] = $ccwMarbles[0] = 0;
	$currentPosition = 0;
	$player = 0;
	$scores = array_fill(0, $players, 0);
	for ($marbleNumber = 1; $marbleNumber <= $lastMarbleNumber; ++$marbleNumber) {
		if ($marbleNumber % 23 === 0) {
			$position = $currentPosition;
			for ($i = 0; $i < 7; ++$i) {
				$position = $ccwMarbles[$position];
			}
			$cwMarbles[$ccwMarbles[$position]] = $cwMarbles[$position];
			$ccwMarbles[$cwMarbles[$position]] = $ccwMarbles[$position];
			$currentPosition = $cwMarbles[$position];
			$scores[$player] += $marbleNumber + $position;
		} else {
			$cwMarbles[$marbleNumber] = $cwMarbles[$cwMarbles[$currentPosition]]; // sets the reference to the +2 marble
			$cwMarbles[$cwMarbles[$currentPosition]] = $marbleNumber; // changes the reference from the +1 marble
			$ccwMarbles[$marbleNumber] = $cwMarbles[$currentPosition];
			$ccwMarbles[$cwMarbles[$marbleNumber]] = $marbleNumber;
			$currentPosition = $marbleNumber;
		}
		$player = ($player + 1) % $players;
	}
	echo 'players: ' . $player . ', last marble number: ' . $lastMarbleNumber . ', max score: ' . max($scores) . ', time: '
		. (microtime(true) - $start) . PHP_EOL;
}
playMarbleGame(10, 25);
playMarbleGame(10, 1618);
playMarbleGame(13, 7999);
playMarbleGame(17, 1104);
playMarbleGame(21, 6111);
playMarbleGame(30, 5807);
playMarbleGame(476, 71657);
playMarbleGame(476, 7165700);

