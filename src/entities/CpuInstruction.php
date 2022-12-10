<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CpuInstruction
{
    private const NOOP = 'noop';
    private const ADDX = 'addx';

    private const cycles = [
        self::NOOP => 1,
        self::ADDX => 2
    ];
    private string $operation;

    private ?int $parameter = null;

    /**
     * @param string $operation
     * @param int|null $parameter
     */
    public function __construct(string $operation, ?int $parameter)
    {
        $this->operation = $operation;
        $this->parameter = $parameter;
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
     * @return int|null
     */
    public function getParameter(): ?int
    {
        return $this->parameter;
    }

    /**
     * @param int|null $parameter
     */
    public function setParameter(?int $parameter): void
    {
        $this->parameter = $parameter;
    }

    public function getCycles(): int
    {
        return self::cycles[$this->operation];
    }

    public function __toString(): string
    {
        return implode(' ', [$this->operation, $this->parameter]);
    }

    public function execute(int $xRegister)
    {
        return match($this->operation) {
            self::NOOP => $xRegister,
            self::ADDX => $xRegister + $this->parameter,
        };
    }
}