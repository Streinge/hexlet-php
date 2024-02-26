<?php

namespace Hexlet\Php\isContinuousSequence;
// BEGIN
function isContinuousSequence($coll)
{
    if (count($coll) <= 1) {
        return false;
    }
    $start = $coll[0];
    foreach ($coll as $i => $item) {
        if ($start + $i !== $item) {
            return false;
        }
    }

    return true;
}


var_dump(isContinuousSequence([10, 11, 12, 13]));     // true
var_dump(isContinuousSequence([10, 11, 12, 14, 15])); // false
var_dump(isContinuousSequence([1, 2, 2, 3]));         // false
var_dump(isContinuousSequence([]));                   // false
