<?php

namespace Jdlcgarcia\Aoc2022\entities;

class GroupOfRucksacks
{
    private const SIZE = 3;
    /** @var Rucksack[] $rucksacks */
    private array $rucksacks = [];

    public function addRuckSack(Rucksack $rucksack): void
    {
        $this->rucksacks[] = $rucksack;
    }

    /**
     * @return array
     */
    public function getRucksacks(): array
    {
        return $this->rucksacks;
    }

    public function isFull(): bool
    {
        return count($this->rucksacks) === self::SIZE;
    }

    public function getPriorityOfBadgeItems(): int
    {
        $firstGroup = $this->rucksacks[0]->getContent();
        $secondGroup = $this->rucksacks[1]->getContent();
        $thirdGroup = $this->rucksacks[2]->getContent();

        $badgeItem = array_intersect($firstGroup, $secondGroup, $thirdGroup);

        return $this->rucksacks[0]->getItemPriority(reset($badgeItem));
    }
}