<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\Rucksack;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('03.txt');

$priorities = 0;
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $rucksack = new Rucksack();
        $rucksack->fill(trim($file->current()));
        $priorities += $rucksack->getRepeatedPriority();
    }

    $file->next();
}

echo $priorities . PHP_EOL;