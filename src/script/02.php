<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\RockPaperScissorsGame;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');
$game = new RockPaperScissorsGame();
while (!$file->eof()) {
    $plays = explode(' ', trim($file->current()));
    $result = $game->addGame($plays[0], $plays[1]);
    $file->next();
}

echo $game->getScore() . PHP_EOL;