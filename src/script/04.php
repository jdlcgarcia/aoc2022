<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\CleanupAssignment;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');
$countCompleteOverlaps = 0;
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        [$firstStart, $firstEnd, $secondStart, $secondEnd] = sscanf(trim($file->current()), '%d-%d,%d-%d');
        $cleanupAssignment = new CleanupAssignment($firstStart, $firstEnd, $secondStart, $secondEnd);
        if ($cleanupAssignment->findCompleteOverlap()) {
            $countCompleteOverlaps++;
        }
    }

    $file->next();
}

echo $countCompleteOverlaps . PHP_EOL;