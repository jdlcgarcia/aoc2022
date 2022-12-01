<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Elf
{
    private int $calories = 0;

    public function addCalories(int $calories): void
    {
        $this->calories += $calories;
    }

    public function getCalories(): int
    {
        return $this->calories;
    }
}