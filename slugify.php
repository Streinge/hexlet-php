<?php

namespace Hexlet\Php;

function slugify(string $str): string
{
    $newStr = strtolower($str);
    $arr = explode(' ', $newStr);
    $result = '';
    foreach ($arr as $item) {
        if ($item !== '') {
            $result .= "{$item}-";
        }
    }
    return substr($result, 0, -1);
}

var_dump(slugify('O la      lu')); // 'o-la-lu'
var_dump(slugify('')); // ''
var_dump(slugify('test')); // 'test'
var_dump(slugify('test me')); // 'test-me'
var_dump(slugify('La La la LA')); // 'la-la-la-la'
var_dump(slugify(' yOu   ')); // 'you'
