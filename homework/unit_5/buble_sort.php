<?php

$arrString = $argv[1] ?? null;
$arr = json_decode($arrString);

if ($arr === null) {
    die(PHP_EOL . 'You should pass an array' . PHP_EOL);
}

try {
    bubleSort($arr);
} catch (Throwable $e) {
    die(PHP_EOL . 'You should pass valid array' . PHP_EOL);
}

echo PHP_EOL, json_encode($arr), PHP_EOL;

function swap(array &$arr, $i, $j)
{
    $temp = $arr[$i];
    $arr[$i] = $arr[$j];
    $arr[$j] = $temp;
}

function bubleSort(array &$arr)
{
    $count = count($arr);

    foreach($arr as $i => $item) {
        for ($j = $count - 1; $j > $i; $j--) {
            if ($arr[$j] < $arr[$j -1]) {
                swap($arr, $j, $j - 1);
            }
        }
    }
}