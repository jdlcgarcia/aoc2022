<?php

namespace Jdlcgarcia\Aoc2022\entities;

class CommDevice
{
    private string $dataStream;
    private int $startOfPacketMarker;
    private int $startOfMessageMarker;

    public function __construct(string $dataStream)
    {
        $this->dataStream = $dataStream;
    }

    public function findStartOfPacketMarker(): int
    {
        $this->startOfPacketMarker = $this->findMarkerBySize(4);

        return $this->startOfPacketMarker;
    }

    public function findStartOfMessageMarker(): int
    {
        $this->startOfMessageMarker = $this->findMarkerBySize(14);

        return $this->startOfMessageMarker;
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

    /**
     * @return int
     */
    public function getStartOfMessageMarker(): int
    {
        return $this->startOfMessageMarker;
    }

    /**
     * @param int $sizeOfMarker
     * @return void
     */
    public function findMarkerBySize(int $sizeOfMarker): int
    {
        $positionToCheck = 0;
        $marker = -1;

        while ($marker === -1) {
            $markerToCheck = str_split(substr($this->dataStream, $positionToCheck, $sizeOfMarker));
            //var_dump($markerToCheck);
            if (sizeof(array_unique($markerToCheck)) === $sizeOfMarker) {
                $marker = $positionToCheck + $sizeOfMarker;
            }

            $positionToCheck++;
        }

        return $marker;
    }
}