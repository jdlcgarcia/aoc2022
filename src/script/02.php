<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\RockPaperScissorsGame;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');
$game = new RockPaperScissorsGame();
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $plays = explode(' ', trim($file->current()));
        $game->addGame($plays[0], $plays[1]);
    }

    $file->next();
}

echo $game->getScoreA() . PHP_EOL;
echo $game->getScoreB() . PHP_EOL;