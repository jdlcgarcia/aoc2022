<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Directory
{
    private int $size;
    private string $name;

    /** @var File[] $files */
    private array $files = [];

    /** @var Directory[] $subdirectories */
    private array $subdirectories = [];

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

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return array
     */
    public function getSubdirectories(): array
    {
        return $this->subdirectories;
    }


}