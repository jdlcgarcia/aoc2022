<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CPU
{
    /** @var CpuInstruction[] $instructions */
    private array $instructions = [];
    private int $xRegister = 1;

    public function loadInstruction(string $operation, ?int $parameter)
    {
        $this->instructions[] = new CpuInstruction($operation, $parameter);
    }

    public function run(?int $cycles = null)
    {
        $cycleCounter = 1;
        $instructionPointer = 0;

        $currentInstruction = $this->instructions[$instructionPointer];
        $operationCycleCounter = $currentInstruction->getCycles();
        while($cycles >= $cycleCounter && $instructionPointer < sizeof($this->instructions)) {
            echo $cycleCounter . ' ';
            $operationCycleCounter--;
            if ($operationCycleCounter === 0) {
                $this->xRegister = $currentInstruction->execute($this->xRegister);
                echo $this->instructions[$instructionPointer] . ' ';

                $instructionPointer++;
                if (isset($this->instructions[$instructionPointer])) {
                    $currentInstruction = $this->instructions[$instructionPointer];
                    $operationCycleCounter = $currentInstruction->getCycles();
                }
            }
            $cycleCounter++;
            echo PHP_EOL;
        }

        return $this->xRegister;
    }
}