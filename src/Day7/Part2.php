<?php

declare(strict_types=1);

namespace Day7;

class Part2
{

    public function solve($inputFile): int
    {
        $rootDirectory = new Directory();
        $currentDirectory = $rootDirectory;
        foreach (file($inputFile, FILE_IGNORE_NEW_LINES) as $line) {
            $lineWords = explode(' ', $line);
            if($lineWords[0] === '$') {
                if($lineWords[1] === 'cd') {
                    $name = $lineWords[2];
                    $currentDirectory = match ($name) {
                        '..' => $currentDirectory->parentDirectory,
                        '/' => $rootDirectory,
                        default =>
                            Directory::$directories[$currentDirectory->fullPath."$name/"]
                            ?? new Directory($name, $currentDirectory),
                    };
                }
            }else{
                $currentDirectory->addWeight((int)$lineWords[0]);
            }
        }
        $directories = array_map(fn(Directory $directory)=> $directory->weight, Directory::$directories);
        $neededSpace = 30000000 - (70000000 - $directories['/']);
        $directories = array_filter($directories, fn(int $weight)=>$weight >= $neededSpace);
        sort($directories);
        return $directories[0];
    }

}

class Directory{

    static array $directories = [];

    public ?Directory $parentDirectory = null;

    public int $weight = 0;

    public string $fullPath;

    public function __construct(string $name = '', ?Directory $parentDirectory = null){
        $this->parentDirectory = $parentDirectory;
        $this->fullPath = $this->parentDirectory?->fullPath."$name/";
        self::$directories[$this->fullPath] = $this;
    }

    public function addWeight(int $weight): void
    {
        $this->weight += $weight;
        $this->parentDirectory?->addWeight($weight);
    }

}