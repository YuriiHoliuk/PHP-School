<?php

$arrString = $argv[1] ?? null;
$reverse = (bool) $argv[2] ?? false;
$arr = json_decode($arrString);

var_export($reverse);

if ($arr === null) {
    die(PHP_EOL . 'You should pass an array' . PHP_EOL);
}

try {
    sortArr($arr, $reverse);
} catch (Throwable $e) {
    die(PHP_EOL . 'You should pass valid array' . PHP_EOL);
}

echo PHP_EOL, json_encode($arr), PHP_EOL;


function merge (&$A, $p, $q, $r, $reverse)
{
    $n1 = $q - $p + 1;
    $n2 = $r - $q;

    $L = [];
    $R = [];

    for ($i = 1; $i <= $n1; $i++) {
        $L[$i] = $A[$p + $i - 1];
    }

    for ($j = 1; $j <= $n2; $j++) {
        $R[$j] = $A[$q + $j];
    }

    $edgeValue = $reverse ? -INF : INF;
    $L[$n1 + 1] = $edgeValue;
    $R[$n2 + 1] = $edgeValue;

    $i = 1;
    $j = 1;

    for ($k = $p; $k <= $r; $k++ ) {
        if($reverse ? $L[$i] >= $R[$j] : $L[$i] <= $R[$j]) {
            $A[$k] = $L[$i];
            $i = $i + 1;
        }
        else {
            $A[$k] = $R[$j];
            $j = $j + 1;
        }
    }
}


function compare($a, $b)
{
    return $a <= $b;
}

function compareReverse($a, $b)
{
    return $a >= $b;
}

function mergeSort(&$A, $p, $r, $reverse)
{
    if($p < $r) {
        $q = floor(($p + $r) / 2 );
        mergeSort($A, $p, $q, $reverse);
        mergeSort($A, $q + 1, $r, $reverse);
        merge($A, $p, $q, $r, $reverse);
    }
}

function sortArr(&$A, $reverse)
{
    mergeSort($A, 0, count($A) - 1, $reverse);
}