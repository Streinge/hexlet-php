<?php

namespace App\Brackets;

// BEGIN
function isBalanced($str)
/* Решение учителя для функции которая принимает на вход строку из
* из круглых скобок и проверяет является ли она сбалансированной
* isBalanced('(())');  // true isBalanced('((())'); // false */
{
    // создается счетчик открывающих скобок "("
    $count = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        // если текущий символ "(", то счетчик увеличивается на единицу
        // если нет, то уменьшается
        $count = $str[$i] === '(' ? $count + 1 : $count - 1;
        // если первый элемент закрывающая скобка, то счетчик будет отрицательным
        // значит сразу false
        if ($count < 0) {
            return false;
        }
    }
    // получается если количестов закрывающих и открывающих скобок
    // совпадает, то счетчик равен нулю
    // здесь возвращается результат проверки этого условия
    return $count === 0;
}