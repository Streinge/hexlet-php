<?php

namespace Hexlet\Php;

function decode(string $signal)
{
    if ($signal === '' || $signal === '|') {
        return '';
    }
    $array = preg_split("//u", $signal, -1, PREG_SPLIT_NO_EMPTY);
    $binar = '';
    $status = true;
    foreach ($array as $arr) {
        if (($arr === '_' || $arr === '¯') && $status) {
            $binar .= "0";
        } elseif ($arr === '|') {
            $binar .= "1";
            $status = false;
        } else {
            $status = true;
        }
    }
    return $binar;
}

var_dump(decode('_|¯|____|¯|__|¯¯¯'));
//var_dump(decode(''));
//var_dump(decode('|'));
//var_dump(decode('¯|__|¯|___|¯¯')); // '010110010'
//var_dump(decode('_|¯¯¯|_|¯¯¯¯|_|¯¯')); //'010011000110'
//var_dump(decode('¯|___|¯¯¯¯¯|___|¯|_|¯')); // '010010000100111'
//var_dump(decode('|¯|___|¯¯¯¯¯|___|¯|_|¯')); // '110010000100111'
