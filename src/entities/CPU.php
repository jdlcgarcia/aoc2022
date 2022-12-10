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
        if (is_null($cycles)) {
            $cycles = sizeof($this->instructions)*2;
        }
        $signalStrength = 0;
        $cycleCounter = 1;
        $instructionPointer = 0;

        $currentInstruction = $this->instructions[$instructionPointer];
        $operationCycleCounter = $currentInstruction->getCycles();
        while($cycles >= $cycleCounter && $instructionPointer < sizeof($this->instructions)) {
            $operationCycleCounter--;
            if ($operationCycleCounter === 0) {
                $this->xRegister = $currentInstruction->execute($this->xRegister);
                $instructionPointer++;
                if (isset($this->instructions[$instructionPointer])) {
                    $currentInstruction = $this->instructions[$instructionPointer];
                    $operationCycleCounter = $currentInstruction->getCycles();
                }
            }
            $cycleCounter++;

            if ((20 + $cycleCounter) % 40 === 0) {
                $signalStrength += $cycleCounter * $this->xRegister;
            }
        }

        return $signalStrength;
    }
}