<?php

namespace Hexlet\Php\SummaryRanges;

function summaryRanges(array $sequence)
{
    $length = count($sequence);
    $result = [];
    if (empty($sequence) || $length === 1) return [];
    $begin = $sequence[0];
    for ($i = 0; $i < $length - 1; $i++) {
        $diff = $sequence[$i + 1] - $sequence[$i];
        if ($diff !== 1) {
            $end = $sequence[$i];
            if ($begin !== $end) $result[] = "{$begin}->{$end}";
            $begin = $sequence[$i + 1];
        }
    }
    $end = $sequence[$length - 1];
    if ($begin !== $end) $result[] = "{$begin}->{$end}";
    return $result;
}
var_dump(summaryRanges([0, 1, 2, 4, 5, 7]));

