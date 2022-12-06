<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Storage
{
    /** @var StackOfBoxes[] */
    private array $stacks = [];

    public function addStack(int $place, StackOfBoxes $stack): void
    {
        $this->stacks[$place] = $stack;
    }

    public function print(): void
    {
        foreach ($this->stacks as $place => $stack) {
            echo $place . ' ' . $stack->print() . PHP_EOL;
        }
    }

    public function loadFromDrawing(string $string): void
    {
        [$place, $boxes] = sscanf($string, '%d %s');
        $cleanBoxes = preg_replace('/[\[\]]/', '', $boxes);
        $stackOfBoxes = new StackOfBoxes();
        foreach (str_split($cleanBoxes) as $box) {
            $stackOfBoxes->pushBox($box);
        }

        $this->addStack($place, $stackOfBoxes);
    }

    public function executeMove9000(int $numberOfBoxes, int $origin, int $end): void
    {
        for($i=1; $i <= $numberOfBoxes; $i++) {
            $this->stacks[$end]->pushBox($this->stacks[$origin]->popBox());
        }
    }

    public function executeMove9001(int $numberOfBoxes, int $origin, int $end): void
    {
        $boxes = $this->stacks[$origin]->multipopBoxes($numberOfBoxes);
        $this->stacks[$end]->multipushBoxes($boxes);
    }

    public function getTops(): string
    {
        $tops = '';
        foreach ($this->stacks as $stack) {
            $tops .= $stack->popBox();
        }

        return $tops;
    }
}