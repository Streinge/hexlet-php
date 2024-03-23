<?php

namespace Hexlet\Php;

const SEC_PER_WEEK = 604800;
const SEC_PER_DAY = 86400;
const NUMBER_WEEK_DAYS = 7;
const RUS_NUMBER_SUNDAY = 7;
const WEEKEND = [6, 7];

function search(array $data, int $number): int
{
    if (empty($data) || !in_array($number, $data, true)) {
        return -1;
    }

    $maxIndex = count($data) - 1;
    $minIndex = 0;
    $currentMaxIndex = $maxIndex;
    $currentMinIndex = $minIndex;
    $currentMiddleIndex = floor($currentMaxIndex  / 2);

    while ($number !== $data[$currentMiddleIndex]) {
        if ($number > $data[$currentMiddleIndex]) {
            $currentMinIndex = $currentMiddleIndex + 1;
            $delta = floor(abs(($currentMaxIndex - $currentMinIndex) / 2));
            $currentMiddleIndex = (int) ($currentMinIndex + $delta);
        } else {
            $currentMaxIndex = $currentMiddleIndex;
            $delta = floor(abs(($currentMaxIndex - $currentMinIndex) / 2));
            $currentMiddleIndex = ($delta < 1) ? $minIndex : (int) ($currentMaxIndex - $delta);
        }
    }
    return $currentMiddleIndex;
}

function weekend(string $begin, string $end): int
{
    $floatWeeks = (strtotime($end) - strtotime($begin) + SEC_PER_DAY) / SEC_PER_WEEK;
    $fullWeeks = (int) floor($floatWeeks);

    if ($floatWeeks === $fullWeeks) {
        return $fullWeeks * 2;
    }

    $numberBegin = (date('w', strtotime($begin)) === '0') ? RUS_NUMBER_SUNDAY : (int) date('w', strtotime($begin));
    $numberEnd = (date('w', strtotime($end)) === '0') ? RUS_NUMBER_SUNDAY : (int) date('w', strtotime($end));

    if ($begin === $end) {
        return (in_array($numberBegin, WEEKEND, true)) ? 1 : 0;
    }

    $numberNonCountDays = ($numberEnd - $numberBegin >= 0)
        ? $numberEnd - $numberBegin + 1 : NUMBER_WEEK_DAYS + $numberEnd - $numberBegin + 1;

    $count = 0;
    for ($i = 0; $i < $numberNonCountDays; $i++) {
        $testedDay = ($numberBegin + $i > NUMBER_WEEK_DAYS)
            ? ($numberBegin + $i) - NUMBER_WEEK_DAYS : $numberBegin + $i;

        if (in_array($testedDay, WEEKEND, true)) {
            $count++;
        }
    }
    return $fullWeeks * 2 + $count;
}

function rgb(int $r, int $g, int $b): int
{
    return $r * 1 + $g * 256 + $b * 65536;
}

function fiborow(int $limit): string
{
    if ($limit === 0) {
        return "0";
    }
    if (($limit === 1)) {
        return "0 1";
    }

    $tested = 1;
    $resultArray = [0, 1, 1];

    while ($tested <= $limit) {
        $tested = $resultArray[(count($resultArray) - 1)] + $resultArray[(count($resultArray) - 2)];
        $resultArray[] = $tested;
    }

    array_pop($resultArray);

    return implode(" ", $resultArray);
}
