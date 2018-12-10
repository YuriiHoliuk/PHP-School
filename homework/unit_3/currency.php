<?php

$arg = $argv[1] ?? null;

if ($arg === null) {
    echo 'You should pass amount';
    return;
}

$amount = intval($arg);

if ($amount > 100000) {
    echo 'Amount should be less then 100000';
    return;
}

$bills = [500, 200, 100, 50, 20, 10, 5, 2, 1];
$res = [];

foreach ($bills as $bill) {
    $count = intdiv($amount, $bill);

    if ($count > 0) {
        $res[$bill] = $count;
    }

    $amount -= ($count * $bill);
}

echo PHP_EOL;
print_r($res);
echo PHP_EOL;
