<?php

namespace Jdlcgarcia\Aoc2022\entities;

class File
{
    private int $size;
    private string $name;

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