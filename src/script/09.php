<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\Point;
use Jdlcgarcia\Aoc2022\entities\Rope;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

$rope = new Rope(new Point(0, 0));
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        [$direction, $steps] = sscanf(trim($file->current()), '%s %d');
        $rope->move($direction, $steps);
    }

    $file->next();
}

echo sizeof($rope->getPositions()). PHP_EOL;
