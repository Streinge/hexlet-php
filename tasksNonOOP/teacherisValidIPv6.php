<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

// BEGIN
use function Funct\Collection\every;
use function Funct\Collection\flattenAll;
use function Funct\Strings\contains;

function isValidIPv6($ip)
{
    // используются функции для работы с многобайтовыми строками
    // про которые я вообще не вспомнил даже
    // mb_stripos ищет позицию перввого вхождения подстроки в строку
    // а mb_strrpos - последнего вхождения подстроки
    // и если они не равны то возвращается false
    // получается здесь сразу отсекаются случаи с несколькими '::' и ':::'
    if (mb_stripos($ip, '::') !== mb_strrpos($ip, '::')) {
        return false;
    }

    // предикат проверяет укороченный ли адрес
    // c помощью функции contains из Collection
    $isShort = contains($ip, '::');
    
    // здесь explode('::', $ip) делит по разделителю на 2 массива, в каждом содержится
    // часть адреса начальная и конечная, но с помощью array_filter в резльтирующий массив
    // попадает тольок группы не пустые ($group !== '')
    $doubleColonGroups = array_filter(explode('::', $ip), function ($group) {
        return $group !== '';
    });
    
    // здесь $doubleColonGroups разделяется на хекстеты и записываются в массив
    // не понял зачем таким способом - то же самое делает просто explode(':', $part)
    $allGroups = array_map(function ($part) {
        return explode(':', $part);
    }, $doubleColonGroups);

    $groups = flattenAll($allGroups);
    var_dump($groups);

    $length = $isShort ? count($groups) + 1 : count($groups);
    var_dump($isShort);
    var_dump($length);
    // здесь проверяется количество хекстетов
    // исключаются случай что если запись короткая, то длина равна 8
    // и случай если количество больше 8
    if ((!$isShort && $length < 8) || ($length > 8)) {
        var_dump(((!$isShort && $length < 8) || ($length > 8)));
        return false;
    }
    
    // здесь проверяется удовлетворяет ли каждый хекстет двум условиям
    // является ли каждая группа шестнадцатиричным числом с помощью
    // функции ctype_xdigit из модуля Ctype и длина хекстета меньше или равно 4
    return every($groups, function ($group) {
        return ctype_xdigit($group) && strlen($group) <= 4;
    });
}
// END
var_dump(isValidIPv6('1::1:'));
