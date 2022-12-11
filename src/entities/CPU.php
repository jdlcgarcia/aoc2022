<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CPU
{
    /** @var CpuInstruction[] $instructions */
    private array $instructions = [];
    private int $xRegister = 1;
    private string $spritePosition;
    private string $crt = '';

    private array $screen = [];

    public function loadInstruction(string $operation, ?int $parameter)
    {
        $this->instructions[] = new CpuInstruction($operation, $parameter);
    }

    public function run(?int $cycles = null)
    {
        if (is_null($cycles)) {
            $cycles = sizeof($this->instructions) * 2;
        }
        $signalStrength = 0;
        $cycleCounter = 1;
        $instructionPointer = 0;

        $currentInstruction = $this->instructions[$instructionPointer];
        $operationCycleCounter = $currentInstruction->getCycles();
        $this->updateSpritePosition();
        while ($cycles >= $cycleCounter && $instructionPointer < sizeof($this->instructions)) {
            $this->drawPixelInCrt($cycleCounter);
            $operationCycleCounter--;
            if ($operationCycleCounter === 0) {
                $this->xRegister = $currentInstruction->execute($this->xRegister);
                $this->updateSpritePosition();
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

    /**
     * @return void
     */
    public function updateSpritePosition(): void
    {
        $this->spritePosition = '';
        $xRegister = $this->xRegister;
        for ($i = 1; $i <= 40; $i++) {
            if ($i >= $xRegister && $i < $xRegister + 3) {
                $this->spritePosition .= '#';
            } else {
                $this->spritePosition .= '.';
            }
        }
    }

    public function printScreen(): void
    {
        foreach($this->screen as $line) {
            echo $line . PHP_EOL;
        }
        echo PHP_EOL;
    }

    /**
     * @param int $xRegister
     */
    public function setXRegister(int $xRegister): void
    {
        $this->xRegister = $xRegister;
    }

    /**
     * @return string
     */
    public function getSpritePosition(): string
    {
        return $this->spritePosition;
    }

    public function debugSpritePosition(): void
    {
        echo 'Sprite position: '.$this->getSpritePosition() . PHP_EOL;
    }

    public function debugCrt()
    {
        echo 'Current CRT row: '.$this->crt . PHP_EOL;
    }

    public function drawPixelInCrt(int $position): void
    {
        $offset = ($position - 1) % 40;
        $this->crt .= substr($this->spritePosition, $offset, 1);
        if ($offset === 39) {
            $this->screen[] = $this->crt;
            $this->crt = '';
        }
    }
}