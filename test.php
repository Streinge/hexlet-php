<?php

namespace Hexlet\Php;

const SEC_PER_WEEK = 604800;
const SEC_PER_DAY = 86400;
const NUMBER_SATURDAY = 6;
const NUMBER_SUNDAY = 7;
const NUMBER_WORK_DAYS = 5;
const RUS_NUMBER_SUNDAY = 7;

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
    $fullWeeks = (int) floor((strtotime($end) - strtotime($begin) + SEC_PER_DAY) / SEC_PER_WEEK);

    $numberBegin = (date('w', strtotime($begin)) === '0') ? RUS_NUMBER_SUNDAY : (int) date('w', strtotime($begin));
    $numberEnd = (date('w', strtotime($end)) === '0') ? RUS_NUMBER_SUNDAY : (int) date('w', strtotime($end))
    ;
    if ($numberBegin - $numberEnd === 1) {
        $nonCountDays = 0;
    } elseif (($numberEnd - $numberBegin) >= 0) {
        $nonCountDays = ($numberEnd === NUMBER_SATURDAY || $numberEnd === NUMBER_SUNDAY)
            ? $numberEnd - NUMBER_WORK_DAYS : 0;
    } else {
        $nonCountDays = ($numberEnd === NUMBER_SATURDAY || $numberEnd === NUMBER_SUNDAY)
            ? $numberEnd - NUMBER_WORK_DAYS : NUMBER_SUNDAY - NUMBER_WORK_DAYS;
    }
    return $fullWeeks * 2 + $nonCountDays;
}

var_dump('Должно быть 10', weekend('27.02.2024', '05.04.2024'));
var_dump('Должно быть 0', weekend('18.03.2024', '18.03.2024'));
var_dump('Должно быть 8', weekend('01.03.2024', '26.03.2024'));
var_dump('Должно быть 11', weekend('27.02.2024', '06.04.2024'));
var_dump('Должно быть 12', weekend('27.02.2024', '07.04.2024'));
var_dump('Должно быть 10', weekend('03.03.2024', '06.04.2024'));
var_dump('Должно быть 11', weekend('03.03.2024', '07.04.2024'));