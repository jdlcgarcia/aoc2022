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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     */
    public function setOperation(string $operation): void
    {
        $this->operation = $operation;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @param string $module
     */
    public function setModule(string $module): void
    {
        $this->module = $module;
    }

    /**
     * @return int
     */
    public function getTestTrue(): int
    {
        return $this->testTrue;
    }

    /**
     * @param int $testTrue
     */
    public function setTestTrue(int $testTrue): void
    {
        $this->testTrue = $testTrue;
    }

    /**
     * @return int
     */
    public function getTestFalse(): int
    {
        return $this->testFalse;
    }

    /**
     * @param int $testFalse
     */
    public function setTestFalse(int $testFalse): void
    {
        $this->testFalse = $testFalse;
    }


    public function debugMonkey(): string
    {
        return 'Monkey ' . $this->id . ':' . PHP_EOL .
            '  Starting items: ' . implode(',', $this->items) . PHP_EOL .
            '  Operation: ' . $this->operation . PHP_EOL .
            '  Test: ' . $this->module . PHP_EOL .
            '    If true: throw to monkey ' . $this->testTrue . PHP_EOL .
            '    If false: throw to monkey ' . $this->testFalse;
    }

    public function calculateWorriness(GMP $item): GMP
    {
        $old = $item;
        $new = 0;
        eval($this->operation.';');

        return $new;
    }

    public function calculateBoredom(GMP $item): GMP
    {
        return $this->calculateWorriness($item);
    }

    public function test(GMP $item)
    {
        $this->testCounter++;

        return gmp_mod($this->calculateBoredom($item), $this->module) === gmp_init(0);
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
}