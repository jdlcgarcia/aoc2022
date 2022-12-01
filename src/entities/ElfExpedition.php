<?php

namespace Jdlcgarcia\Aoc2022\entities;

class ElfExpedition
{
    /* @var Elf[] $elves */
    private array $elves = [];

    public function addElf(Elf $elf): void
    {
        $this->elves[] = $elf;
    }

    public function getElfWithMaxCalories(): Elf {
        $maxCaloriesElf = new Elf();
        foreach($this->elves as $elf) {
            if ($maxCaloriesElf->getCalories() < $elf->getCalories()) {
                $maxCaloriesElf = $elf;
            }
        }

        return $maxCaloriesElf;
    }
}