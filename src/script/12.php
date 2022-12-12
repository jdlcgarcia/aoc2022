<?php

require_once 'vendor/autoload.php';

use Jdlcgarcia\Aoc2022\common\BreadthFirstSearch;
use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\common\Graph;

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

$matrix = [];

while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $matrix[] = trim($file->current());
    }

    $file->next();
}

$graph = new Graph($matrix);
$bfs = new BreadthFirstSearch($graph);
$bfs->execute();
var_dump($bfs->getSteps()[$graph->getStartNode()]);
