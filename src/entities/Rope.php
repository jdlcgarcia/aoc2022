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
        for ($i = 0; $i < $numberOfSegments; $i++) {
            $this->segments[$i] = new Segment($startingPoint);
        }
        $this->print();
    }

    public function move(string $direction, int $steps): void
    {
        echo '== '.$direction.' '.$steps.' =='.PHP_EOL;
        for ($i = 0; $i < $steps; $i++) {
            $this->segments[0]->step($direction);


            if ($this->lastMovingSegment < $this->numberOfSegments - 1) {
                $this->lastMovingSegment++;
            }
            for ($j = 1; $j <= $this->lastMovingSegment; $j++) {
//                echo "moved segment $j from ".$this->segments[$j]->getHead()->format();
                $this->segments[$j]->moveHead($this->segments[$j-1]->getTail()->getX(), $this->segments[$j-1]->getTail()->getY());
                $this->segments[$j]->moveTail();
//                echo " to ".$this->segments[$j]->getHead()->format() . PHP_EOL;
            }
            echo $this->segments[1]->getHead()->format() . PHP_EOL;
            $this->print();
        }
//        $this->print();
        //die();
    }

    public function getTailPositions(): array
    {
        return $this->segments[$this->numberOfSegments-1]->getTailPositions();
    }

    private function print()
    {
        if ($this->numberOfSegments > 1) {
            $matrix8 = $this->segments[8]->print('8', '9');
            $matrix7 = $this->segments[7]->print('7', '8');
            $matrix6 = $this->segments[6]->print('6', '7');
            $matrix5 = $this->segments[5]->print('5', '6');
            $matrix4 = $this->segments[4]->print('4', '5');
            $matrix3 = $this->segments[3]->print('3', '4');
            $matrix2 = $this->segments[2]->print('2', '3');
            $matrix1 = $this->segments[1]->print('1', '2');
            $matrix0 = $this->segments[0]->print('H', '1');
//            $matrix = $matrix0 + $matrix1 + $matrix2 + $matrix3 + $matrix4 + $matrix5 + $matrix6 + $matrix7 + $matrix8 + $matrix9;
            $matrix = $matrix1;
            $i1 = 5;
            $i2 = 0;
            $i3 = 0;
            $i4 = 5;

//            $i1 = 15;
//            $i2 = -5;
//            $i3 = -11;
//            $i4 = 14;

            for ($j = $i1; $j >= $i2; $j--) {
                for ($i = $i3; $i <= $i4; $i++) {
                    if (!isset($matrix[$i][$j])) {
                        $matrix[$i][$j] = '.';
                    }
                    echo $matrix[$i][$j];
                }
                echo PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
}