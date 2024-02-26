<?php


// BEGIN
/* alternative solution
function sumIntervals($intervals)
{
    $values = [];
    foreach ($intervals as [$start, $end]) {
        for ($i = $start; $i < $end; $i++) {
            $values[$i] = 1;
        }
    }
    return array_sum($values);
}
 */
function sumIntervals($intervals)
{
    $values = [];
    foreach ($intervals as [$start, $end]) {
        for ($i = $start; $i < $end; $i++) {
            $values[] = $i;
        }
    }
    $uniqValues = array_unique($values);
    return count($uniqValues);
}
// END