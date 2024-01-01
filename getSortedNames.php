<?php

namespace Hexlet\Php;

function getSortedNames(array $users): array
{
    $result = [];
    foreach ($users as ['name' => $name]) {
        $result[] = $name;
    }
    sort($result);
    return $result;
}
