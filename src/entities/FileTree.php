<?php

namespace Jdlcgarcia\Aoc2022\entities;

class FileTree
{
    private Directory $root;

    public function readCommand(string $command)
    {
        if (str_starts_with($command, '$')) {
            [$action, $directory] = sscanf($command, '$ %s %s');
            echo $action . PHP_EOL;
        }
    }


}