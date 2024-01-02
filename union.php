<?php

namespace Hexlet\Php;

function union($first, ...$rest)
{
    $uniques = array_unique(array_merge($first, ...$rest));
    $result = [];
    foreach ($uniques as $unic) {
        $result[] = $unic;
    }
    return $result;
}
