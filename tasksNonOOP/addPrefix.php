<?php

namespace Hexlet\Php\AddPrefix;

function addPrefix(array $items, string $prefix): array
// Менять входные даные - плохая практика поэтому 
// на входе создаем новый массив и его возвращаем
{
    $result = [];
    for ($i = 0, $lenght = count($items); $i < $lenght; $i++) {
        $result[$i] = "{$prefix} {$items[$i]}";
    }
    return $result;
}
$names = ['john', 'smith', 'karl'];
 
$newNames = addPrefix($names, 'Mr');
print_r($newNames);
// => ['Mr john', 'Mr smith', 'Mr karl'];
