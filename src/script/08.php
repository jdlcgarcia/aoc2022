<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\Forest;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

$forest = new Forest();
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $forest->loadRow(trim($file->current()));
    }

    $file->next();
}

//$forest->print();
echo $forest->getVisibleTrees() . PHP_EOL;