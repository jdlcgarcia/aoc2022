<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\GroupOfRucksacks;
use Jdlcgarcia\Aoc2022\entities\Rucksack;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('test.txt');

$priority = 0;
$badgeItemPriority = 0;
$group = new GroupOfRucksacks();
while (!$file->eof()) {
    if (trim($file->current()) !== '') {
        $rucksack = new Rucksack();
        $rucksack->fill(trim($file->current()));
        $priority += $rucksack->getRepeatedPriority();

        if (!$group->isFull()) {
            $group->addRuckSack($rucksack);
        }

        if ($group->isFull()) {
            $badgeItemPriority += $group->getPriorityOfBadgeItems();
            $group = new GroupOfRucksacks();
        }
    }

    $file->next();
}

echo $priority . PHP_EOL;
echo $badgeItemPriority . PHP_EOL;