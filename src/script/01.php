<?php

use Jdlcgarcia\Aoc2022\common\FileHandler;
use Jdlcgarcia\Aoc2022\entities\Elf;
use Jdlcgarcia\Aoc2022\entities\ElfExpedition;

require_once 'vendor/autoload.php';

$fileHandler = new FileHandler();
$file = $fileHandler->loadFileContent('01.txt');

$expedition = new ElfExpedition();
$elf = new Elf();
while (!$file->eof()) {
    if ($file->current() !== PHP_EOL) {
        $elf->addCalories((int)$file->current());
    } else {
        $expedition->addElf($elf);
        $elf = new Elf();
    }
    $file->next();
}
$expedition->addElf($elf);

echo $expedition->getElfWithMostCalories()->getCalories() . PHP_EOL;
echo $expedition->getCaloriesCarriedByTopThreeElves() . PHP_EOL;