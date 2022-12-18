# Advent of Code

This repository contains my personals PHP 8 solutions to the 2022 [Advent of code](https://adventofcode.com
) !

Each `Day` folder contains the two parts of the puzzle solution in separate files. No factoring has been made between each parts as I wanted each file to be standalone.

I focused on optimisation and writing the fewer code possible instead of speed as a personal exercise to improve my PHP knowledge.

Solution structure may vary between each day to provide a solution that's optimized and simple but also understandable. Thus, some puzzles are solved with procedural programming whiles others are solved with OOP.

An entry point has been made so that every day and part algorithm can be called easily.

## How to use

```
php index.php -d {day} -p {part} (--test)
```

Use `d` parameter to specify day

Use `p` parameter to specify part

Add `--test` if you want to use test input provided in the puzzle as an exemple

**Ex 1 :**

```
php index.php -d 5 -p 1
```

Will return Day 5 Part 1 Puzzle result

**Ex 2 :**

```
php index.php -d 2 -p 2 --test
```

Will return Day 2 Part 2 Puzzle result using exemple puzzle input


## Credits : ##

**Puzzles** : [Eric Wastl](https://github.com/topaz)

**Solution implementations** : [Damien Cortina](https://github.com/damiencortina)
