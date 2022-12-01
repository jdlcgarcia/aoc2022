<?php

namespace Jdlcgarcia\Aoc2022\common;

class FileHandler
{
    private const PATH = 'input/';
    private array $content;

    public function getContent(): array
    {
        return $this->content;
    }

    public function loadFileContent(string $filename): array
    {
        $this->content = file(self::PATH . $filename);

        return $this->getContent();
    }
}