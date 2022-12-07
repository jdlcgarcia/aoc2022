<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\FileTree;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

$fileTree = new FileTree();
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $fileTree->readCommand(trim($file->current()));
    }

    $file->next();
}