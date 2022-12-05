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