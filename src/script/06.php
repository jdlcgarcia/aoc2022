<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\CommDevice;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $commDevice = new CommDevice(trim($file->current()));
        echo $commDevice->findStartOfPacketMarker() . PHP_EOL;
    }

    $file->next();
}