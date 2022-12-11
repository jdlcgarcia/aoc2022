<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Monkey
{
    private int $id;
    /** @var int[] $items */
    private array $items;
    private string $operation;
    private string $test;
    private int $testTrue;
    private int $testFalse;
    private $testCounter = 0;

    /**
     * @param int $id
     * @param int[] $items
     * @param string $operation
     * @param string $test
     * @param int $testTrue
     * @param int $testFalse
     */
    public function __construct(int $id, array $items, string $operation, string $test, int $testTrue, int $testFalse)
    {
        $this->id = $id;
        $this->items = $items;
        $this->operation = $operation;
        $this->test = $test;
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
     * @return array
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
        $this->items = $items;
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
    public function getTest(): string
    {
        return $this->test;
    }

    /**
     * @param string $test
     */
    public function setTest(string $test): void
    {
        $this->test = $test;
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
            '  Test: ' . $this->test . PHP_EOL .
            '    If true: throw to monkey ' . $this->testTrue . PHP_EOL .
            '    If false: throw to monkey ' . $this->testFalse;
    }

    public function calculateWorriness(int $item): int
    {
        $old = $item;
        $new = 0;
        eval($this->operation.';');

        return $new;
    }

    public function calculateBoredom(int $item): int
    {
        return floor($this->calculateWorriness($item) / 3);
    }

    public function test(int $item)
    {
        $this->testCounter++;
        $boredom = $this->calculateBoredom($item);
        eval('$result = $boredom '.$this->getTest().' === 0;');

        return $result;
    }

    public function removeItem(int $key): void
    {
        unset($this->items[$key]);
    }

    public function addItem(int $item)
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