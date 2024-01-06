<?php

namespace Hexlet\Php;

function decode(string $signal)
{
    $array = preg_split("//u", $signal, -1, PREG_SPLIT_NO_EMPTY);
    return $array;
    $binar = '';
    $status = true;
    foreach ($array as $arr) {
        if ($arr === '_' && $status) {
            $binar .= "0";
        } elseif ($arr === '|') {
            $binar .= "1";
        }
    }
}

var_dump(decode('_|¯|____|¯|__|¯¯¯'));