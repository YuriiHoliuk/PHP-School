<?php

const SPACE = ' ';

$size = $argv[1] ?? 11;
$symbol = $argv[2] ?? '👽';

validate($size);

$diamond = createShape($symbol, $size);

echo $diamond;

function validate($size) {
    if ($size % 2 === 0) {
        die(PHP_EOL . 'Size should be odd' . PHP_EOL);
    }
}

function createShape(string $symbol, int $size)
{
    $repeats = $size * 2 - 1;
    $resultStr = '';

    for($i = 0; $i <= $repeats; $i++) {
        $spaceRepeats = calculateSpaceRepeats($repeats, $size, $i);
        $symbolRepeats = calculateSymbolRepeats($size, $i);
        $resultStr = $resultStr
            . str_repeat(SPACE, $spaceRepeats)
            . str_repeat($symbol . SPACE, $symbolRepeats)
            . PHP_EOL;
    }

    return $resultStr;
}

function calculateSpaceRepeats($repeats, $size, $index)
{
  $spaces = abs(($repeats - 1) / 2 - $index + 1);

  if ($size - $i < 0) {
    $spaces = $spaces + 1;
  }

  return $spaces;
}

function calculateSymbolRepeats($size, $index)
{
  return $size - $index < 0
    ? $size - ($index - $size)
    : $index;
}