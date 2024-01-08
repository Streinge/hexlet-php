<?php

namespace App\Solution;

// BEGIN
function ipToInt(string $ip)
/* Здесь используется ранее не известный мне способ преобразования
   Получается если каждый разряд записать как шестнадцатиричное число
   Если необходимо добавить ноль перед ним, чтобы каждое число было двухразрядное
   и потом записать все это в одну строку, то это будет шестнадцатиричное
   представление итогового десятичного числа.
*/
{
    $numbers = explode('.', $ip);
    $hexNumbers = array_map(function ($value) {
        $hexNumber = dechex($value);
        return str_pad($hexNumber, 2, 0, STR_PAD_LEFT);
    }, $numbers);
    var_dump($hexNumbers);
    $ipInHex = implode('', $hexNumbers);
    var_dump($ipInHex);
    return hexdec($ipInHex);
}

function intToIp(int $int)
/* Здесь используется обратное преобразование
   Сначала десятичное число переводится в шестандатиричное
   потом дополняется если необходимо нулем слева, чтобы было 8 чисел
   разделяется парами в массив и отображается с переводом в десятичную
   систему, ну и потом массив собирается в строку
*/
{
    $ipInHex = dechex($int);
    $temp = str_pad($ipInHex, 8, 0, STR_PAD_LEFT);
    var_dump($temp);
    $hexNumbers = str_split($temp, 2);
    $decNumbers = array_map(fn($number) => hexdec($number), $hexNumbers);
    return implode('.', $decNumbers);
}
// END

var_dump(intToIp(167801600));
//[0, '0.0.0.0'],
//[4294967295, '255.255.255.255'],
//[32, '0.0.0.32'],
//[2149583361, '128.32.10.1'],
//[2154959208, '128.114.17.104'],
//[3221225584, '192.0.0.112'],
//[167801600, '10.0.115.0']