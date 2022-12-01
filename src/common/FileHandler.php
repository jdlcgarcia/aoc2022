<?php

namespace Jdlcgarcia\Aoc2022\common;

class FileHandler
{
    private const PATH = 'input/';
    private string $content;

    public function getContent(): string
    {
        return $this->content;
    }

    public function loadFileContent(string $filename): string
    {
        $this->content = file_get_contents(self::PATH . $filename, FILE_USE_INCLUDE_PATH);

        return $this->getContent();
    }
}