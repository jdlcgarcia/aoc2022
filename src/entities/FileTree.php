<?php

namespace Jdlcgarcia\Aoc2022\entities;

use SplFileObject;

class FileTree
{
    private Directory $root;
    private SplFileObject $listOfCommands;
    private Directory $currentDirectory;
    private const SMALL_FOLDER_THRESHOLD = 100000;

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
        if ($this->detectAction($command)) {
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
            $this->createDirectory($directoryToChange);
            $this->currentDirectory = $this->currentDirectory->getDirectory($directory);
        }
    }

    private function listDirectory(): void
    {
        $this->listOfCommands->next();

        while (!$this->detectAction($this->listOfCommands->current()) && !$this->listOfCommands->eof()) {
            if (trim($this->listOfCommands->current()) !== '') {
                [$info, $name] = sscanf(trim($this->listOfCommands->current()), '%s %s');
                match ($info) {
                    'dir' => $this->createDirectory(new Directory($name)),
                    default => $this->createFile(new File($name, (int)$info))
                };
            }

            $this->listOfCommands->next();
        }

        $this->stepBack();
    }

    /**
     * @param Directory $directory
     * @return void
     */
    public function createDirectory(Directory $directory): void
    {
        if (is_null($this->currentDirectory->getDirectory($directory->getName()))) {
            $directory->setParent($this->currentDirectory);
            $this->currentDirectory->addDirectory($directory);
        }
    }

    private function createFile(File $file)
    {
        if (is_null($this->currentDirectory->getFile($file->getName()))) {
            $this->currentDirectory->addFile($file);
            $this->currentDirectory->increaseSize($file->getSize());
        }
    }

    /**
     * @param string $command
     * @return bool
     */
    public function detectAction(string $command): bool
    {
        return str_starts_with($command, '$');
    }

    private function stepBack()
    {
        $this->listOfCommands->seek($this->listOfCommands->key() - 1);
    }

    /**
     * @return Directory
     */
    public function getRoot(): Directory
    {
        return $this->root;
    }

    public function detectSmallDirectories(): int
    {
        return $this->findSmallSubdirectories($this->getRoot());
    }

    private function findSmallSubdirectories(Directory $parent): int
    {
        $sizeToClean = 0;
        foreach($parent->getSubdirectories() as $directory) {
            if ($directory->getSize() < self::SMALL_FOLDER_THRESHOLD) {
                $sizeToClean += $directory->getSize();
            }

            $sizeToClean += $this->findSmallSubdirectories($directory);
        }

        return $sizeToClean;
    }

}