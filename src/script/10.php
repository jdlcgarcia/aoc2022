<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\CPU;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

$cpu = new CPU();
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        [$operation, $parameter] = sscanf(trim($file->current()), '%s %s');
        $cpu->loadInstruction($operation, $parameter);
    }

    $file->next();
}

echo $cpu->run();