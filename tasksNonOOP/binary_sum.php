<?php

namespace App\Solution;
// Реализуйте функцию binarySum, которая принимает
// на вход два бинарных числа (в виде строк) и возвращает их 
// сумму. Результат (вычисленная сумма) также должен быть 
// бинарным числом в виде строки.
// BEGIN
function binarySum($first, $second)
{
    return decbin((bindec($first) + bindec($second)));
}
// END