<?php

namespace Jdlcgarcia\Aoc2022\entities;

use SplFileObject;

class FileTree
{
    private Directory $root;
    private SplFileObject $listOfCommands;
    private Directory $currentDirectory;

    function __construct(SplFileObject $listOfCommands)
    {
        $this->listOfCommands = $listOfCommands;
    }

    public function run(): void
    {
        while (!$this->listOfCommands->eof()) {
            if (trim($this->listOfCommands->current()) !== '') {
                $this->readCommand(trim($this->listOfCommands->current()));
            }

            $this->listOfCommands->next();
        }
    }

    public function readCommand(string $command): void
    {
        if (str_starts_with($command, '$')) {
            [$action, $directory] = sscanf($command, '$ %s %s');
            match ($action) {
                'cd' => $this->changeDirectory($directory),
                'ls' => $this->listDirectory()
            };
        }
    }

    private function changeDirectory(string $directory): void
    {
        $directoryToChange = new Directory($directory);
        if ($directory === '/') {
            $this->root = $directoryToChange;
            $this->currentDirectory = $this->root;
        } elseif ($directory === '..') {
            $this->currentDirectory = $this->currentDirectory->getParent();
        } else {
            if (is_null($this->currentDirectory->getDirectory($directory))) {
                $this->createDirectory($directoryToChange);
            }
            $this->currentDirectory = $this->currentDirectory->getDirectory($directory);
        }
    }

    private function listDirectory(): void
    {
        echo "Listing directory ".$this->currentDirectory->getPath() . PHP_EOL;
    }

    /**
     * @param Directory $directoryToChange
     * @return void
     */
    public function createDirectory(Directory $directoryToChange): void
    {
        $directoryToChange->setParent($this->currentDirectory);
        $this->currentDirectory->addDirectory($directoryToChange);
    }


}