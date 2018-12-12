<?php

$length = $argv[1] ?? null;

if ($length === null || !ctype_digit($length)) {
    die(PHP_EOL . 'You shoul pass length(integer)' . PHP_EOL);
}

$table = rowsToColumns(createTable($length));

renderTable($table);

function createColumn($length, $index)
{
    $column = [];
    $start = $length * $index + 1;
    $end = $start + $length;

    for ($i = 0; $i < $length; $i++) {
        array_push($column, $start + $i);
    }

    if ($index % 2 === 1) {
        return array_reverse($column);
    }

    return $column;
}

function createTable($length)
{
    $table = [];

    for ($i = 0; $i < $length; $i++) {
        array_push($table, createColumn($length, $i));
    }

    return $table;
}

function rowsToColumns($input)
{
    $result = [];

    foreach($input as $index => $value) {
        array_push($result, array_column($input, $index));
    }

    return $result;
}

function renderTable($table)
{
    echo PHP_EOL;

    foreach ($table as $row) {
        echo implode(' ', $row), PHP_EOL;
    }
}
