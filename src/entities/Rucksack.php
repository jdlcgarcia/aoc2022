<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Rucksack
{
    const ASCII_OFFSET_LOWERCASE = 96;
    const ASCII_OFFSET_UPPERCASE = 64 - 26;
    private string $firstCompartment = '';
    private string $secondCompartment = '';
    private array $firstCompartmentPriority = [];
    private array $secondCompartmentPriority = [];

    private ?int $repeatedPriority = null;

    public function fill(string $items): void
    {
        $this->firstCompartment = substr($items, 0, strlen($items) / 2);
        $this->secondCompartment = substr($items, strlen($items) / 2, strlen($items));
        $this->calculateFirstCompartmentPriority();
        $this->calculateSecondCompartmentPriority();

        $commonItem = array_intersect($this->firstCompartmentPriority, $this->secondCompartmentPriority);
        if (!empty($commonItem)) {
            $this->repeatedPriority = reset($commonItem);
        }
    }

    public function calculateFirstCompartmentPriority(): void
    {
        foreach (str_split($this->firstCompartment) as $item) {
            $this->firstCompartmentPriority[] = $this->getItemPriority($item);
        }
    }

    public function calculateSecondCompartmentPriority(): void
    {
        foreach (str_split($this->secondCompartment) as $item) {
            $this->secondCompartmentPriority[] = $this->getItemPriority($item);
        }
    }

    /**
     * @return int|null
     */
    public function getRepeatedPriority(): ?int
    {
        return $this->repeatedPriority;
    }

    /**
     * @param mixed $item
     * @return int
     */
    public function getItemPriority(mixed $item): int
    {
        return ord($item) - (
            (ord($item) >= 65 && ord($item) <= 90) ?
                self::ASCII_OFFSET_UPPERCASE :
                self::ASCII_OFFSET_LOWERCASE
            );
    }

    public function getContent(): array
    {
        return str_split($this->firstCompartment . $this->secondCompartment);
    }
}