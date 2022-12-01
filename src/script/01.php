<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('01.txt');

$max = 0;
$caloriesCounter = 0;
while (!$file->eof()) {
    if ($file->current() === PHP_EOL) {
        if ($max <= $caloriesCounter) {
            $max = $caloriesCounter;
        }
        $caloriesCounter = 0;
    } else {
        $caloriesCounter += (int)$file->current();
    }
    $file->next();
}

echo $max;