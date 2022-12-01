<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$content = $fileHandler->loadFileContent('test.txt');
var_dump($content);
