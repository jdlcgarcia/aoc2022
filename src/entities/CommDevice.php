<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CommDevice
{
    private string $dataStream;
    private int $startOfPacketMarker;

    public function __construct(string $dataStream)
    {
        $this->dataStream = $dataStream;
    }

    public function findStartOfPacketMarker(): int
    {
        for ($i = 3; $i < strlen($this->dataStream); $i++) {
            if (sizeof(array_unique([
                    $this->dataStream[$i],
                    $this->dataStream[$i - 1],
                    $this->dataStream[$i - 2],
                    $this->dataStream[$i - 3],
                ])) === 4) {
                $this->startOfPacketMarker = $i+1;

                return $this->startOfPacketMarker;
            }
        }

        return -1;
    }

    /**
     * @return string
     */
    public function getDataStream(): string
    {
        return $this->dataStream;
    }

    /**
     * @return int
     */
    public function getStartOfPacketMarker(): int
    {
        return $this->startOfPacketMarker;
    }
}