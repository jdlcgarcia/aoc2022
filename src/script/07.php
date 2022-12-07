<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\FileTree;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('07.txt');

$fileTree = new FileTree($file);
$fileTree->run();

echo $fileTree->detectSmallDirectories() . PHP_EOL;
echo $fileTree->findSmallestBigDirectoryWhichWouldFitTheUpdate() . PHP_EOL;
