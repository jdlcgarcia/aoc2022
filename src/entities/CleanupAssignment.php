<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CleanupAssignment
{
    private string $firstAssignment = '';
    private string $secondAssignment = '';

    public function __construct(int $firstStart, int $firstEnd, int $secondStart, int $secondEnd)
    {
        for ($i = $firstStart; $i <= $firstEnd; $i++) {
            $this->firstAssignment .=  '#'. $i . '#';
        }
        for ($i = $secondStart; $i <= $secondEnd; $i++) {
            $this->secondAssignment .= '#'. $i . '#';
        }
    }

    public function findCompleteOverlap(): bool
    {
        return !empty(str_contains($this->firstAssignment, $this->secondAssignment))
            || !empty(str_contains($this->secondAssignment, $this->firstAssignment));
    }
}