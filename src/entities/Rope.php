<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Rope
{
    private const UP = 'U';
    private const RIGHT = 'R';
    private const DOWN = 'D';
    private const LEFT = 'L';
    private Point $head;
    private Point $tail;

    private Point $carryMove;

    /** @var Point[] $positions */
    private array $positions;

    public function __construct(Point $startingPoint)
    {
        $this->head = $startingPoint;
        $this->tail = $startingPoint;
        $this->includeTailPosition();
        //$this->print();
    }

    public function move(string $direction, int $steps): void
    {
        for ($i = 0; $i < $steps; $i++) {
            $this->step($direction);
        }
    }

    private function moveHead(int $getX, int $getY): void
    {
        $this->carryMove = $this->head;
        $newPosition = new Point($getX, $getY);
        $this->head = $newPosition;
    }

    private function includeTailPosition(): void
    {
        $this->positions[$this->tail->format()] = $this->tail;
    }

    public function getPositions(): array
    {
        return $this->positions;
    }

    private function moveTail(): void
    {
        if (!$this->adjacentHeadAndTail()) {
            $this->tail = $this->carryMove;
            $this->includeTailPosition();
        }
    }

    private function adjacentHeadAndTail(): bool
    {
        if ($this->head->getX() === $this->tail->getX() && $this->head->getY() === $this->tail->getY()) {
            return true;
        }

        if ($this->head->getX() === $this->tail->getX() && abs($this->head->getY() - $this->tail->getY()) === 1) {
            return true;
        }

        if ($this->head->getY() === $this->tail->getY() && abs($this->head->getX() - $this->tail->getX()) === 1) {
            return true;
        }

        if (abs($this->head->getY() - $this->tail->getY()) === 1 && abs($this->head->getX() - $this->tail->getX()) === 1) {
            return true;
        }

        return false;
    }

    /**
     * @param string $direction
     * @return void
     */
    public function step(string $direction): void
    {
        match ($direction) {
            self::UP => $this->moveHead($this->head->getX(), $this->head->getY() + 1),
            self::RIGHT => $this->moveHead($this->head->getX() + 1, $this->head->getY()),
            self::DOWN => $this->moveHead($this->head->getX(), $this->head->getY() - 1),
            self::LEFT => $this->moveHead($this->head->getX() - 1, $this->head->getY()),
        };
        $this->moveTail();
    }

    private function print()
    {
        for($j = 5; $j >= 0; $j--) {
            for ($i = 0; $i <= 5; $i++) {
                $print = '.';
                if ($i === 0 && $j === 0) {
                    $print = 's';
                }

                if ($i === $this->tail->getX() && $j === $this->tail->getY()) {
                    $print = 'T';
                }

                if ($i === $this->head->getX() && $j === $this->head->getY()) {
                    $print = 'H';
                }

                echo $print;
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
}