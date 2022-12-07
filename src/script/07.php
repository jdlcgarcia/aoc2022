<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\FileTree;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

$fileTree = new FileTree($file);
$fileTree->run();

echo 'The total size of directory e is ' . $fileTree->getRoot()->getDirectory('a')->getDirectory('e')->getSize() . PHP_EOL;
echo 'The directory a has total size ' . $fileTree->getRoot()->getDirectory('a')->getSize() . PHP_EOL;
echo 'Directory d has total size ' . $fileTree->getRoot()->getDirectory('d')->getSize() . PHP_EOL;
echo 'As the outermost directory, / contains every file. Its total size is ' . $fileTree->getRoot()->getSize() . PHP_EOL;