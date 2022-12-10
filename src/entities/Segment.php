<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Segment
{
    private const UP = 'U';
    private const RIGHT = 'R';
    private const DOWN = 'D';
    private const LEFT = 'L';
    private Point $head;
    private Point $tail;

    private Point $carryMove;


    /** @var Point[] $tailPositions */
    private array $tailPositions;

    public function __construct(Point $startingPoint)
    {
        $this->head = $startingPoint;
        $this->tail = $startingPoint;
        $this->includeTailPosition();
    }

    private function includeTailPosition(): void
    {
        $this->tailPositions[$this->tail->format()] = $this->tail;
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

    public function moveHead(int $getX, int $getY): void
    {
        $this->carryMove = $this->head;
        $newPosition = new Point($getX, $getY);
        $this->head = $newPosition;
    }

    public function moveTail(): void
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

    public function getTailPositions(): array
    {
        return $this->tailPositions;
    }

    public function print(string $headCharacter, string $tailCharacter): array
    {
        $arrayToPrint = [];
        for($j = 15; $j >= -15; $j--) {
            for ($i = -15; $i <= 15; $i++) {
                //$arrayToPrint[$i][$j] = '.';
                if ($i === 0 && $j === 0) {
                    $arrayToPrint[$i][$j] = 's';
                }

                if ($i === $this->tail->getX() && $j === $this->tail->getY()) {
                    $arrayToPrint[$i][$j] = $tailCharacter;
                }

                if ($i === $this->head->getX() && $j === $this->head->getY()) {
                    $arrayToPrint[$i][$j] = $headCharacter;
                }

            }
        }

        return $arrayToPrint;
    }

    /**
     * @return Point
     */
    public function getHead(): Point
    {
        return $this->head;
    }

    /**
     * @param Point $head
     */
    public function setHead(Point $head): void
    {
        $this->head = $head;
    }

    /**
     * @return Point
     */
    public function getTail(): Point
    {
        return $this->tail;
    }

    /**
     * @param Point $tail
     */
    public function setTail(Point $tail): void
    {
        $this->tail = $tail;
    }
}