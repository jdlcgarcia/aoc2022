<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Rope
{
    /** @var Segment[] $segments */
    private array $segments;

    private int $lastMovingSegment = 0;

    private int $numberOfSegments;


    public function __construct(Point $startingPoint, int $numberOfSegments = 1)
    {
        $this->numberOfSegments = $numberOfSegments;
        for($i = 0; $i < $numberOfSegments; $i++) {
            $this->segments[$i] = new Segment($startingPoint);
        }
    }

    public function move(string $direction, int $steps): void
    {
        for ($i = 0; $i < $steps; $i++) {
            for ($j = 0; $j <= $this->lastMovingSegment; $j++) {
                $this->segments[$j]->step($direction);
            }
            if ($this->lastMovingSegment < $this->numberOfSegments - 1) {
                $this->lastMovingSegment++;
            }
        }
    }



    public function getTailPositions(): array
    {
        $positions = [];
        foreach($this->segments as $segment) {
            $positions = array_merge($positions, $segment->getTailPositions());
        }
        return $positions;
    }
}