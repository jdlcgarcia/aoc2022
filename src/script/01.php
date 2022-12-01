<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$fileHandler->loadFileContent('test.txt');
var_dump($fileHandler->getContent());