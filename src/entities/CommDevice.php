<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CommDevice
{
    private string $dataStream;
    private int $startOfPacketMarker = -1;

    public function __construct(string $dataStream)
    {
        $this->dataStream = $dataStream;
    }

    public function findStartOfPacketMarker(): int
    {
        $positionToCheck = 0;
        while($this->startOfPacketMarker === -1) {
            $markerToCheck = str_split(substr($this->dataStream, $positionToCheck, 4));
            if (sizeof(array_unique($markerToCheck)) === 4) {
                $this->startOfPacketMarker = $positionToCheck + 4;
            }

            $positionToCheck++;
        }

        return $this->startOfPacketMarker;
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