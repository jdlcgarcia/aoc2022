<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Forest
{
    /** @var Tree[][] */
    private array $trees;
    private const SIZE = 99;
    private int $maxScenicScore = 0;

    public function loadRow(string $trim): void
    {
        $row = [];
        foreach (str_split($trim) as $treeHeight) {
            $tree = new Tree($treeHeight);
            $row[] = $tree;
        }

        $this->trees[] = $row;
    }

    public function getVisibleTrees(): int
    {
        $visibleTrees = 0;
        for ($i = 0; $i < self::SIZE; $i++) {
            for ($j = 0; $j < self::SIZE; $j++) {
                if ($i === 0 || $j === 0 || $i === self::SIZE - 1 || $j === self::SIZE - 1) {
                    $this->trees[$i][$j]->setVisible(true);
                    $visibleTrees++;
                    continue;
                }

                if ($this->isVisibleFromAnyDirection($i, $j)) {
                    $this->trees[$i][$j]->setVisible(true);
                    $visibleTrees++;
                }
            }
        }

        return $visibleTrees;
    }

    public function print()
    {
        foreach ($this->trees as $treeRow) {
            foreach ($treeRow as $tree) {
                echo $tree->getHeight();
            }
            echo PHP_EOL;
        }
    }

    private function isVisibleFromAnyDirection(int $x, int $y): bool
    {
        $checks = 0;
        $partialScenicScores = [0, 0, 0, 0];

        $checks++;
        for ($i = $x-1; $i >= 0; $i--) {
            $partialScenicScores[0]++;
            if ($this->trees[$i][$y]->getHeight() >= $this->trees[$x][$y]->getHeight()) {
                $checks--;
                break;
            }
        }

        $checks++;
        for ($i = $x+1; $i < self::SIZE; $i++) {
            $partialScenicScores[1]++;
            if ($this->trees[$i][$y]->getHeight() >= $this->trees[$x][$y]->getHeight()) {
                $checks--;
                break;
            }
        }

        $checks++;
        for ($j = $y-1; $j >= 0; $j--) {
            $partialScenicScores[2]++;
            if ($this->trees[$x][$j]->getHeight() >= $this->trees[$x][$y]->getHeight()) {
                $checks--;
                break;
            }
        }

        $checks++;
        for ($j = $y+1; $j < self::SIZE; $j++) {
            $partialScenicScores[3]++;
            if ($this->trees[$x][$j]->getHeight() >= $this->trees[$x][$y]->getHeight()) {
                $checks--;
                break;
            }
        }
        $this->trees[$x][$y]->setScenicScore($partialScenicScores[0] * $partialScenicScores[1] * $partialScenicScores[2] * $partialScenicScores[3]);
        if ($this->trees[$x][$y]->getScenicScore() > $this->maxScenicScore) {
            $this->maxScenicScore = $this->trees[$x][$y]->getScenicScore();
        }

        return $checks > 0;
    }

    public function getMaxScenicScore(): int
    {
        return $this->maxScenicScore;
    }


}