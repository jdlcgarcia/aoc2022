<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\Storage;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('05_diagram.txt');

$storage = new Storage();
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $storage->loadFromDrawing(trim($file->current()));
    }

    $file->next();
}

$storage->print();

$file = $fileHandler->loadFileContent('05_moves.txt');
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        [$numberOfBoxes, $origin, $end] = sscanf(trim($file->current()), 'move %d from %d to %d');
        $storage->executeMove($numberOfBoxes, $origin, $end);
    }

    $file->next();
}

echo '======= AFTER PROCESSING =======' . PHP_EOL;
$storage->print();
echo $storage->getTops() . PHP_EOL;