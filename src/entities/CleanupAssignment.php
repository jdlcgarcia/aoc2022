<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CleanupAssignment
{
    private array $firstAssignment = [];
    private array $secondAssignment = [];

    public function __construct(int $firstStart, int $firstEnd, int $secondStart, int $secondEnd)
    {
        for ($i = $firstStart; $i <= $firstEnd; $i++) {
            $this->firstAssignment[] =  $i;
        }
        for ($i = $secondStart; $i <= $secondEnd; $i++) {
            $this->secondAssignment[] = $i;
        }
    }

    public function findCompleteOverlap(): bool
    {
        return empty(array_diff($this->firstAssignment, $this->secondAssignment))
            || empty(array_diff($this->secondAssignment, $this->firstAssignment));
    }

    public function findPartialOverlap(): bool
    {
        return !empty(array_intersect($this->firstAssignment, $this->secondAssignment));
    }
}