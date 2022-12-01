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

    public function getElfWithMostCalories(): Elf {
        $maxCaloriesElf = new Elf();
        foreach($this->elves as $elf) {
            if ($maxCaloriesElf->getCalories() < $elf->getCalories()) {
                $maxCaloriesElf = $elf;
            }
        }

        return $maxCaloriesElf;
    }

    public function getCaloriesCarriedByTopThreeElves(): int
    {
        $topThreeElves = [
            new Elf(),
            new Elf(),
            new Elf()
        ];

        foreach($this->elves as $elf) {
            if ($this->compareElves($topThreeElves[0], $elf) === -1) {
                $topThreeElves[0] = $elf;
                usort($topThreeElves, [ElfExpedition::class, 'compareElves']);
            }
        }

        return $topThreeElves[0]->getCalories() + $topThreeElves[1]->getCalories() + $topThreeElves[2]->getCalories();
    }

    private function compareElves(Elf $a, Elf $b)
    {
        return $a->getCalories() <=> $b->getCalories();
    }
}