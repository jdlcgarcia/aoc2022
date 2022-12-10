<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\Point;
use Jdlcgarcia\Aoc2022\entities\Rope;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

//$rope1segment = new Rope(new Point(0, 0));
$rope10segment = new Rope(new Point(0, 0), 10);
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        [$direction, $steps] = sscanf(trim($file->current()), '%s %d');
//        $rope1segment->move($direction, $steps);
        $rope10segment->move($direction, $steps);
    }

    $file->next();
}

//echo sizeof($rope1segment->getTailPositions()). PHP_EOL;
//echo sizeof($rope10segment->getTailPositions()). PHP_EOL;
//var_dump($rope10segment->getTailPositions());