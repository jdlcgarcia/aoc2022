<?php

namespace Jdlcgarcia\Aoc2022\common;

use SplFileObject;

class FileHandler
{
    private const PATH = 'input/';
    private SplFileObject $file;

    public function loadFileContent(string $filename): SplFileObject
    {
        $this->file = new SplFileObject(self::PATH . $filename,"r");

        return $this->file;
    }
}