<?php

namespace Jdlcgarcia\Aoc2022\entities;

class StackOfBoxes
{
    private array $boxes = [];

    public function pushBox(string $box): void
    {
        $this->boxes[] = $box;
    }

    public function print(): string
    {
        $drawing = '';
        foreach($this->boxes as $box) {
            $drawing .= '['.$box.']';
        }

        return $drawing;
    }

    public function popBox(): ?string
    {
        return array_pop($this->boxes);
    }

    public function multipopBoxes(int $numberOfBoxes): array
    {
        return array_splice($this->boxes, -1 * $numberOfBoxes);
    }

    public function multipushBoxes(array $boxes)
    {
        $this->boxes = array_merge($this->boxes, $boxes);
    }
}