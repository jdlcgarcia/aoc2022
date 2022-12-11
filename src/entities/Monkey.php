<?php

namespace Jdlcgarcia\Aoc2022\entities;

use GMP;

class Monkey
{
    private int $id;
    /** @var GMP[] $items */
    private array $items;
    private string $operation;
    private string $module;
    private int $testTrue;
    private int $testFalse;
    private $testCounter = 0;

    private GMP $worryLevel;

    /**
     * @param int $id
     * @param int[] $items
     * @param string $operation
     * @param int $module
     * @param int $testTrue
     * @param int $testFalse
     */
    public function __construct(int $id, array $items, string $operation, int $module, int $testTrue, int $testFalse)
    {
        $this->id = $id;
        $this->setItems($items);
        $this->operation = $operation;
        $this->module = $module;
        $this->testTrue = $testTrue;
        $this->testFalse = $testFalse;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return GMP[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        foreach($items as $item) {
            $this->items[] = gmp_init($item);
        }
    }

    /**
     * @return int
     */
    public function getTestTrue(): int
    {
        return $this->testTrue;
    }

    /**
     * @return int
     */
    public function getTestFalse(): int
    {
        return $this->testFalse;
    }

    public function calculateWorryLevel(GMP $item): void
    {
        $old = $item;
        $new = gmp_init(0);
        eval($this->operation.';');

        $this->worryLevel = $new;
    }

    public function test(GMP $item)
    {
        $this->testCounter++;

        return gmp_mod($this->getWorryLevel(), $this->module) == 0;
    }

    public function removeItem(int $key): void
    {
        unset($this->items[$key]);
    }

    public function addItem(GMP $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return int
     */
    public function getTestCounter(): int
    {
        return $this->testCounter;
    }

    /**
     * @return GMP
     */
    public function getWorryLevel(): GMP
    {
        return $this->worryLevel;
    }
}