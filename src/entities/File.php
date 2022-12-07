<?php

namespace Jdlcgarcia\Aoc2022\entities;

class File
{
    private int $size = 0;
    private string $name;

    /**
     * @param string $name
     * @param int $size
     */
    public function __construct(string $name, int $size)
    {
        $this->name = $name;
        $this->size = $size;
    }


    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}