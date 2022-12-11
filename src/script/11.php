<?php

use Jdlcgarcia\Aoc2022\entities\Monkey;

require_once 'vendor/autoload.php';


$testMonkeys = [
    new Monkey(0, [79, 98], '*', '19', 23, 2, 3),
    new Monkey(1, [54, 65, 75, 74], '+', '6', 19, 2, 0),
    new Monkey(2, [79, 60, 97], '*', 'self', 13, 1, 3),
    new Monkey(3, [74], '+', '3', 17, 0, 1)
];

$superModuloTestMonkeys = gmp_init(23 * 19 * 13 * 17);

$monkeys = [
    new Monkey(0, [57], '*', '13', 11, 3, 2),
    new Monkey(1, [58, 93, 88, 81, 72, 73, 65], '+', '2', 7, 6, 7),
    new Monkey(2, [65, 95], '+', '6', 13, 3, 5),
    new Monkey(3, [58, 80, 81, 83], '*', 'self', 5, 4, 5),
    new Monkey(4, [58, 89, 90, 96, 55], '+', '3', 3, 1, 7),
    new Monkey(5, [66, 73, 87, 58, 62, 67], '*', '7', 17, 4, 1),
    new Monkey(6, [85, 55, 89], '+', '4', 2, 2, 0),
    new Monkey(7, [73, 80, 54, 94, 90, 52, 69, 58], '+', '7', 19, 6, 0),
];

$superModuloMonkeys = gmp_init(11 * 7 * 13 * 5 * 3 * 17 * 2 * 19);

/**
 * @param Monkey[] $monkeys
 * @return void
 */
function executeRound(array $monkeys, GMP $superModulo): void
{
    foreach ($monkeys as $monkey) {
        foreach ($monkey->getItems() as $key => $item) {
            if ($monkey->test($item, $superModulo)) {
                $targetMonkey = $monkey->getTestTrue();
            } else {
                $targetMonkey = $monkey->getTestFalse();
            }
            $monkey->removeItem($key);
            $monkeys[$targetMonkey]->addItem($monkey->getWorryLevel());
        }
    }
}

for ($i = 0; $i < 10000; $i++) {
    echo "======= ROUND $i =======" . PHP_EOL;
    executeRound($monkeys, $superModuloMonkeys);
}

foreach ($monkeys as $monkey) {
    echo 'Monkey ' . $monkey->getId() . ' inspected items ' . $monkey->getTestCounter() . ' times. ' . PHP_EOL;
}

echo 166922 * 169205 . PHP_EOL;