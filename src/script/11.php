<?php

use Jdlcgarcia\Aoc2022\entities\Monkey;

require_once 'vendor/autoload.php';


$testMonkeys = [
    new Monkey(0, [79, 98], '$new = gmp_mul($old, 19)', 23, 2, 3),
    new Monkey(1, [54, 65, 75, 74], '$new = gmp_add($old, 6)', 19, 2, 0),
    new Monkey(2, [79, 60, 97], '$new = gmp_mul($old, $old)', 13, 1, 3),
    new Monkey(3, [74], '$new = gmp_add($old, 3)', 17, 0, 1)
];

$monkeys = [
    new Monkey(0, [57], '$new = $old * 13', 11, 3, 2),
    new Monkey(1, [58, 93, 88, 81, 72, 73, 65], '$new = $old + 2', 7, 6, 7),
    new Monkey(2, [65, 95], '$new = $old + 6', 13, 3, 5),
    new Monkey(3, [58, 80, 81, 83], '$new = $old * $old', 5, 4, 5),
    new Monkey(4, [58, 89, 90, 96, 55], '$new = $old + 3', 3, 1, 7),
    new Monkey(5, [66, 73, 87, 58, 62, 67], '$new = $old * 7', 17, 4, 1),
    new Monkey(6, [85, 55, 89], '$new = $old + 4', 2, 2, 0),
    new Monkey(7, [73, 80, 54, 94, 90, 52, 69, 58], '$new = $old + 7', 19, 6, 0),
];

/**
 * @param Monkey[] $monkeys
 * @return void
 */
function executeRound(array $monkeys): void
{
    foreach ($monkeys as $monkey) {
        foreach ($monkey->getItems() as $key => $item) {
            $monkey->calculateWorryLevel($item);
            if ($monkey->test($item)) {
                $targetMonkey = $monkey->getTestTrue();
            } else {
                $targetMonkey = $monkey->getTestFalse();
            }
            $monkey->removeItem($key);
            $monkeys[$targetMonkey]->addItem($monkey->getWorryLevel());
        }
    }
}

for ($i = 0; $i < 1000; $i++) {
    echo "======= ROUND $i =======".PHP_EOL;
    executeRound($testMonkeys);
}

foreach ($testMonkeys as $monkey) {
    echo 'Monkey ' . $monkey->getId() . ' inspected items ' . $monkey->getTestCounter() . ' times. ' . PHP_EOL;
}

echo 350 * 347 . PHP_EOL;