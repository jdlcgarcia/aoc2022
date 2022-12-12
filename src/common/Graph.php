<?php

namespace Jdlcgarcia\Aoc2022\common;

class Graph
{
    private array $matrix;
    private array $adjacencyList = [];

    private ?string $startNode = null;
    private ?string $endNode = null;

    private array $possibleStartingPoints = [];

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;

        for ($i = 0, $w = strlen($this->matrix[0]); $i < $w; $i++) {
            for ($j = 0, $h = count($this->matrix); $j < $h; $j++) {
                $k = json_encode([$i, $j]);
                if (!isset($this->adjacencyList[$k])) {
                    $this->adjacencyList[$k] = [];
                }

                $v = $this->findValue($i, $j);

                if ($i > 0 && $this->adjacent($v, $this->findValue($i - 1, $j))) {
                    $this->adjacencyList[$k][] = json_encode([$i - 1, $j]);
                }
                if ($i < $w - 1 && $this->adjacent($v, $this->findValue($i + 1, $j))) {
                    $this->adjacencyList[$k][] = json_encode([$i + 1, $j]);
                }
                if ($j > 0 && $this->adjacent($v, $this->findValue($i, $j - 1))) {
                    $this->adjacencyList[$k][] = json_encode([$i, $j - 1]);
                }
                if ($j < $h - 1 && $this->adjacent($v, $this->findValue($i, $j + 1))) {
                    $this->adjacencyList[$k][] = json_encode([$i, $j + 1]);
                }
            }
        }
    }

    private function findValue(int $i, int $j)
    {
        $value = $this->matrix[$j][$i];
        if ($value === 'S') {
            if (!$this->startNode) {
                $this->startNode = json_encode([$i, $j]);
                $this->possibleStartingPoints[$this->startNode] = 1;
            }

            return 'a';
        } elseif ($value === 'E') {
            if (!$this->endNode) {
                $this->endNode = json_encode([$i, $j]);
            }

            return 'z';
        } elseif ($value === 'a') {
            $this->possibleStartingPoints[json_encode([$i, $j])] = 1;
        }

        return $value;
    }

    private function adjacent(string $a, string $b): bool
    {
        return ord($b) - ord($a) <= 1;
    }

    /**
     * @return string|null
     */
    public function getEndNode(): ?string
    {
        return $this->endNode;
    }

    public function getAdjacentNodes(mixed $node)
    {
        return $this->adjacencyList[$node];
    }

    /**
     * @return string|null
     */
    public function getStartNode(): ?string
    {
        return $this->startNode;
    }

    /**
     * @return array
     */
    public function getPossibleStartingPoints(): array
    {
        return $this->possibleStartingPoints;
    }
}