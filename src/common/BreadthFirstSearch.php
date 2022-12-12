<?php

namespace Jdlcgarcia\Aoc2022\common;

use SplQueue;

class BreadthFirstSearch
{
    private Graph $graph;
    private array $steps = [];

    /**
     * @param Graph $graph
     */
    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }

    public function execute(): void
    {
        if ($shortestPath = $this->searchShortestPath($this->graph->getStartNode())) {
            $this->steps[$this->graph->getStartNode()] = count($shortestPath) - 1;
        }

        asort($this->steps);
    }

    private function searchShortestPath(string $start)
    {
        $visitedNodes = [];
        $queue = new SplQueue();
        $queue->enqueue([$start]);
        $visitedNodes[$start] = 0;
        while ($queue->count()) {
            $builtPath = $queue->dequeue();
            $previousNode = $builtPath[count($builtPath) - 1];
            if ($previousNode === $this->graph->getEndNode()) {
                return $builtPath;
            }

            foreach ($this->graph->getAdjacentNodes($previousNode) as $adjacentNode) {
                if (!isset($visitedNodes[$adjacentNode])) {
                    $visitedNodes[$adjacentNode] = count($builtPath);
                    $shorterBuiltPath = $builtPath;
                    $shorterBuiltPath[] = $adjacentNode;
                    $queue->enqueue($shorterBuiltPath);
                }
            }
        }

        return [];
    }

    /**
     * @return array
     */
    public function getSteps(): array
    {
        return $this->steps;
    }
}