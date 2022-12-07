<?php

namespace Jdlcgarcia\Aoc2022\entities;

class Directory
{
    private int $size = 0;
    private string $name;
    private ?Directory $parent = null;

    /** @var File[] $files */
    private array $files = [];

    /** @var Directory[] $subdirectories */
    private array $subdirectories = [];

    public function __construct(string $name)
    {
        $this->name = $name;
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

    public function getDirectory(string $directory): ?Directory
    {
        if (!isset($this->subdirectories[$directory])) {
            return null;
        }

        return $this->subdirectories[$directory];
    }

    public function getPath(): string
    {
        if (is_null($this->parent)) {
            return '';
        }

        return $this->parent->getPath() . '/' . $this->getName();
    }

    public function setParent(Directory $parentDirectory): void
    {
        $this->parent = $parentDirectory;
    }

    public function addDirectory(Directory $directory)
    {
        $this->subdirectories[$directory->getName()] = $directory;
    }

    public function getParent(): ?Directory
    {
        return $this->parent;
    }

    public function getFile(string $filename): ?File
    {
        if (!isset($this->files[$filename])) {
            return null;
        }

        return $this->files[$filename];
    }

    public function addFile(File $file)
    {
        $this->files[$file->getName()] = $file;
    }

    public function increaseSize(int $childSize): void
    {
        $this->size += $childSize;

        if (!is_null($this->parent)) {
            $this->parent->increaseSize($childSize);
        }
    }
}